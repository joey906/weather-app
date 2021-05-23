<?php
declare(strict_types=1);

namespace App\Controller;

use \App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($msg = null)
    {
        $this->viewBuilder()->setLayout('top');
        $users = $this->paginate($this->Users);

        $this->set(compact('msg'));
        $this->set(compact('users'));
       
    }

    public function loginForm($msg = null) {
        $this->set(compact('msg'));
        $this->viewBuilder()->setLayout('top');
    }

    public function login($name = null, $pass = null) {
        if (isset($name) !== true) {
            $name = $_POST['name'];
            $pass = $_POST['pass'];
        }
        
        $query = $this->Users->find('all');
        $data = $query->toArray();

        for ($i = 0; $i < count($data); $i++) {
            $data2 = $data[$i]->toArray();
            if (in_array($name, $data2)  && in_array($pass, $data2)) {
                $userName = $name;
                $userPass = $pass;
                $userEmail = $data2['email'];
                $userPref = $data2['pref'];
                $this->set(compact('userName'));
                $this->set(compact('userPass'));
                $this->set(compact('userEmail'));
                $this->redirect(['action' => 'main', $userName, $userPass, $userEmail, $userPref]);
            } else {
                $msg = "ログインできませんでした。";
                $this->set(compact('msg'));
                $this->render('/users/login_form');
            }
        }
        
        $this->set(compact('data'));
    }

    public function main($userName = null, $userPass = null, $userEmail = null, $userPref = null) {
        $session = $this->getRequest()->getSession();
        $this->viewBuilder()->setLayout('top');
        $session->write('name', $userName);
        $session->write('email', $userEmail);
        $session->write('pass', $userPass);
        $session->write('pref', $userPref);

        date_default_timezone_set('Asia/Tokyo');
        $today = date("Y-m-d");
        $tomorrow =  date('Y-m-d', strtotime('+1 day'));
        $nextTwoDay = date('Y-m-d', strtotime('+2 day'));
        $a = date('Y-m-d', strtotime('+3 day'));
        $time = date('H:i:s');

        $urel1 = 'https://www.javadrive.jp/google-maps-javascript/data/data/pref.json';
        $json1 = file_get_contents($urel1);
        $arr1 = json_decode($json1, true);

        for ($i = 0; $i < count($arr1['marker']); $i++) {
            if ($arr1['marker'][$i]['pref'] == $userPref) {
                $lat = $arr1['marker'][$i]['lat'];
                $lng = $arr1['marker'][$i]['lng'];
            }
        }

        $session->write('lat', $lat);
        $session->write('lng', $lng);


        if (isset($lat) !== false && isset($lng) !== false) {
            $url = 'http://api.openweathermap.org/data/2.5/forecast?lat='.$lat.'&lon='.$lng.'&APPID=eab87663f44a4300f0f18c9692026723';
            $json = file_get_contents($url);
            $arr = json_decode($json, true);
            $todayWeather = [];
            $tomorrowWeather = [];
            $nextTwoWeather = [];
            $B = [];
        
            for ($i = 0; $i < count($arr['list']); $i++) {
                $weatherDay = $arr['list'][$i]['dt_txt'];
        
                if (strpos($weatherDay, $today) !== false) {
                    $todayWeather[] = $arr['list'][$i];
                } elseif (strpos($weatherDay, $tomorrow) !== false) {
                    $tomorrowWeather[] = $arr['list'][$i];
                } elseif (strpos($weatherDay, $nextTwoDay) !== false) {
                    $nextTwoWeather[] = $arr['list'][$i];
                } elseif (strpos($weatherDay, $a) !== false) {
                    $B[] = $arr['list'][$i];
                }
            }
        }
        $this->Flash->success('ログインに成功しました。');
        $this->set(compact('todayWeather'));
        $this->set(compact('tomorrowWeather'));
        $this->set(compact('nextTwoWeather'));
        $this->set(compact('B'));
    }

    public function newForm() {
        $this->viewBuilder()->setLayout('top');
        
    }

    public function logout() {
        $session = $this->getRequest()->getSession();
        $session->destroy();
        $this->redirect(['action' => 'index']);
    }



    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    
    public function add()
    {
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $pref = $_POST['prefecture'];

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->name = $name;
            $user->email = $email;
            $user->pass = $pass;
            $user->pref = $pref;
            if ($this->Users->save($user)) {
                $msg = '始めるにはログインしてください。';

                $this->set(compact('msg'));
                return $this->redirect(['action' => 'login', $name, $pass]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
