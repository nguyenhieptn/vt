<?php
class SentrySeeder extends Seeder {

	public function run()
	{
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('users_groups')->delete();

        $user = Sentry::createUser(array(
            'email'       => 'admin@admin.com',
            'username'       => 'admin',
            'password'    => "admin",
            'first_name'  => 'John',
            'last_name'   => 'McClane',
            'activated'   => 1,
        ));

        $group = Sentry::createGroup(array(
            'name'        => 'Admin',
            'permissions' => array(
                'admin' => 1
            ),
        ));
 
        // Assign user permissions
        $adminUser  = Sentry::findUserByLogin('admin');
        $adminGroup = Sentry::findGroupByName('Admin');
        $adminUser->addGroup($adminGroup);
	}

}