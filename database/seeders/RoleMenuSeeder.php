<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleMenuSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('role_menus')->truncate();
    DB::table('role_menus')->insert($this->getMemberMenus());
    DB::table('role_menus')->insert($this->getAccountantMenus());
    DB::table('role_menus')->insert($this->getHrMenus());
    DB::table('role_menus')->insert($this->getArchiverMenus());
  }

  private function getMenus(int $role_id)
  {
    $menus = [];

    foreach ([1, 2, 3, 4, 5, 6] as $menu_id) {
      array_push($menus, [
        'role_id' => $role_id,
        'menu_id' => $menu_id,
        'is_can_create' => false,
        'is_can_update' => false,
        'is_can_delete' => false
      ]);
    }

    foreach ([11, 12] as $menu_id) {
      array_push($menus, [
        'role_id' => $role_id,
        'menu_id' => $menu_id,
        'is_can_create' => true,
        'is_can_update' => true,
        'is_can_delete' => true
      ]);
    }

    return $menus;
  }

  private function getMemberMenus()
  {
    return $this->getMenus(1);
  }

  private function getAccountantMenus()
  {
    $menus = $this->getMenus(2);

    $menu_index = 2;

    $menus[$menu_index]['is_can_create'] = true;
    $menus[$menu_index]['is_can_update'] = true;
    $menus[$menu_index]['is_can_delete'] = true;

    return $menus;
  }

  private function getHrMenus()
  {
    $menus = $this->getMenus(3);

    $menu_index = 3;

    $menus[$menu_index]['is_can_create'] = true;
    $menus[$menu_index]['is_can_update'] = true;
    $menus[$menu_index]['is_can_delete'] = true;

    return $menus;
  }

  private function getArchiverMenus()
  {
    $menus = $this->getMenus(4);

    $menu_index = 4;

    $menus[$menu_index]['is_can_create'] = true;
    $menus[$menu_index]['is_can_update'] = true;
    $menus[$menu_index]['is_can_delete'] = true;

    $menu_index = 5;

    $menus[$menu_index]['is_can_create'] = true;
    $menus[$menu_index]['is_can_update'] = true;
    $menus[$menu_index]['is_can_delete'] = true;

    return $menus;
  }
}
