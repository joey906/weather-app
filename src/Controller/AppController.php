<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        date_default_timezone_set('Asia/Tokyo');
        $today = date("Y-m-d");
        $day = date("Y-m");
        $Y = date("Y");
        $m = date("m");
        $d = date("d");
        $tomorrow =  date('Y-m-d', strtotime('+1 day'));
        $nextTwoDay = date('Y-m-d', strtotime('+2 day'));
        $a = date('Y-m-d', strtotime('+3 day'));
        $time = date('H:i:s');

        $urel1 = 'https://www.javadrive.jp/google-maps-javascript/data/data/pref.json';
        $json1 = file_get_contents($urel1);
        $arr1 = json_decode($json1, true);



        for ($i = 0; $i < count($arr1['marker']); $i++) {
            unset($arr1['marker'][$i]['url']);
            unset($arr1['marker'][$i]['addr']);
        }

        $this->set(compact('today'));
        $this->set(compact('tomorrow'));
        $this->set(compact('nextTwoDay'));
        $this->set(compact('a'));
        $this->set(compact('arr1'));
       

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }
}
