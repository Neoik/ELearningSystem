<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


      factory(App\User::class, 10)->make()->each(function($u){
          $u->save();
          $role_user = Role::where('name', 'user')->first();
          $u->roles()->save($role_user);
      });
        $role_manager = Role::where('name', 'manager')->first();
        factory(App\User::class, 2)->make()->each(function($u) use ($role_manager) {
            $u->save();

            $u->roles()->save($role_manager);
        });
      factory(App\User::class, 1)->make()->each(function($u){
          $u->save();
          $role_user = Role::where('name', 'user')->first();
          $u->roles()->save($role_user);
          $u->name = "meh";
          $u->password = bcrypt("secret");
          $u->email = "meh@me.com";
          $u->save();
      });
      factory(App\User::class, 1)->make()->each(function($u){
          $u->save();
          $role_user = Role::where('name', 'manager')->first();
          $u->roles()->save($role_user);
          $u->name = "meh_admin";
          $u->password = bcrypt("secret");
          $u->email = "meh_admin@me.com";
          $u->save();
      });
    }
}
