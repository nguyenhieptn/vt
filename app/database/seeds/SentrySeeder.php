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

        $user2 = Sentry::createUser(array(
            'email'       => 'member@member.com',
            'username'       => 'member1',
            'password'    => "member1",
            'first_name'  => 'member',
            'last_name'   => 'McClane',
            'activated'   => 1,
        ));

        $groupAdmin = Sentry::createGroup(array(
            'name'        => 'admin',
            'permissions' => array(
                'admin' => 1
            ),
        ));

        $groupMember = Sentry::createGroup(array(
            'name'        => 'member',
            'permissions' => array(
                'member' => 1
            ),
        ));
 
        // Assign user permissions
        $adminUser  = Sentry::findUserByLogin('admin');
        $adminGroup = Sentry::findGroupByName('admin');
        $adminUser->addGroup($adminGroup);

        $mUser  = Sentry::findUserByLogin('member1');
        $mGroup = Sentry::findGroupByName('member');
        $mUser->addGroup($mGroup);
	}

}