<?php

use App\Interfaces\Acl\PermissionRepositoryInterface;
use App\Interfaces\Acl\RoleRepositoryInterface;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class AclTableSeeder
 */
class AclTableSeeder extends Seeder
{
    /** @var \App\Interfaces\Acl\RoleRepositoryInterface $roleRepository */
    protected $roleRepository;

    /** @var \App\Interfaces\Acl\PermissionRepositoryInterface $permissionRepository */
    protected $permissionRepository;

    /**
     * AclTableSeeder constructor.
     *
     * @param  RoleRepositoryInterface $roleRepository Abstraction layer for the ACL roles.
     * @return void
     */
    public function __construct(RoleRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Seed the default permissions
        foreach ($this->permissionRepository->defaultPermissions() as $permission) {
            $this->permissionRepository->firstOrCreate(['name' => $permission]);
        }

        $this->command->info('Default permissions added.');

        // Confirm roles needed
        if ($this->command->confirm('Create roles for user, default is admin and user?', true)) {
            // Ask for roles from input
            $inputRoles = $this->command->ask('Enter roles in comma separate format.', 'Admin, User');

            foreach (explode(',', $inputRoles) as $role) { // App roles
                $role = $this->roleRepository->firstOrCreate(['name' => trim($role)]);

                if ($role->name == 'Admin') { // Assign all permissions
                    $role->syncPermissions($this->permissionRepository->all());
                    $this->command->info('Admin granted all the permissions.');
                } else { // For others by default only read access
                    $role->syncPermissions($this->permissionRepository->getUserPermissions());
                }

                // Create one user for each role
                $this->createUser($role);
            }

            $this->command->info("Roles {$inputRoles} added successfully");
        } else {
            $this->roleRepository->firstOrCreate(['name' => 'User']);
            $this->command->info('Added only default user role.');
        }
    }

    /**
     * Create a user with given role.
     *
     * @param  Role $role The resource entity from the role.
     * @return void
     */
    private function createUser(Role $role): void
    {
        $user = factory(User::class)->create(['password' => 'secret']);
        $user->assignRole($role->name);

        if ($role->name == 'Admin') {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "secret"');
        }
    }
}
