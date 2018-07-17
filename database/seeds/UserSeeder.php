<?php
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$admin = new \App\Models\Role();
$admin->name         = 'admin';
$admin->display_name = '后台管理员'; // optional
$admin->description  = '具备后台管理的权限'; // optional
$admin->save();

//还需要什么权限吗。。。无语  就我一个管理员  就来个赋值权限得了

$role1 = new \App\Models\Role();
$role1->name = "user";
$role1->display_name = "普通用户";
$role1->description = "注册的普通用户";



$user = \App\Models\User::create([
'name'=>'lmx',
'password'=>bcrypt('12345678'),
'email'=>'449399575@qq.com'
]);

$userinfo = \App\Models\UserInfo::create([
'user_id'=>$user->id,
'nick'=>"未来笔记",
'description'=>'我是全世界最菜的php程序员'
]);

//把该用户添加到admin用户组
$user->attachRole($admin);

//创建一个权限
$manageQuestion = new \App\Models\Permission();
$manageQuestion->name         = 'admin';
$manageQuestion->display_name = '后台管理'; // optional
$manageQuestion->description  = '具备后台管理权限'; // optional
$manageQuestion->save();
//把权限分配给某个角色
$admin->attachPermission($manageQuestion);


$manageQuestion = new \App\Models\Permission();
$manageQuestion->name         = 'admin.tags';
$manageQuestion->display_name = '管理标签'; // optional

$manageQuestion->description  = '管理标签权限'; // optional
$manageQuestion->save();




$user = \App\Models\User::create([
'name'=>'baidu',
'password'=>bcrypt('123456'),
'email'=>'654321@qq.com'
]);

$userinfo = \App\Models\UserInfo::create([
'user_id'=>$user->id,
'nick'=>'百度',
'description'=>'我是全世界最牛的php程序员'
]);


}
}
