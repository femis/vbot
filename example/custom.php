<?php
/**
 * Created by PhpStorm.
 * User: HanSon
 * Date: 2016/12/7
 * Time: 16:33
 */

require_once __DIR__ . './../vendor/autoload.php';

use Hanson\Vbot\Foundation\Vbot;
use Hanson\Vbot\Message\Entity\Text;

$robot = new Vbot([
    'tmp' => __DIR__ . '/./../tmp/',
]);

$flag = false;

$robot->server->setCustomerHandler(function() use (&$flag){
    // RemarkName,代表的改用户在你通讯录的名字
    $contact = contact()->getUsernameByNickRemarkName('hanson');
    if ($contact === false){
        dd("找不到你要的联系人，请确认联系人姓名");
    }
    if(!$flag){
        Text::send($contact, '来轰炸吧');
        $flag = true;
    }

    Text::send($contact, '测试' . \Carbon\Carbon::now()->toDateTimeString());

});

$robot->server->run();
