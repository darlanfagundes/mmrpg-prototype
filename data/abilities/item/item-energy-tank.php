<?
// ITEM : ENERGY TANK
$ability = array(
  'ability_name' => 'Energy Tank',
  'ability_token' => 'item-energy-tank',
  'ability_game' => 'MM00',
  'ability_class' => 'item',
  'ability_type' => 'energy',
  'ability_description' => 'A large health tank that restores 100% life energy to one robot on the user\'s side of the field.',
  'ability_energy' => 0,
  'ability_speed' => 10,
  'ability_recovery' => 100,
  'ability_recovery_percent' => true,
  'ability_accuracy' => 100,
  'ability_target' => 'select_this',
  'ability_function' => function($objects){
    
    // Extract all objects into the current scope
    extract($objects);
    
    // Target this robot's self
    $this_ability->target_options_update(array(
      'frame' => 'summon',
      'success' => array(0, 40, -2, 99,
        $this_player->print_player_name().' uses an item from the inventory&hellip; <br />'.
        $target_robot->print_robot_name().' is given the '.$this_ability->print_ability_name().'!'
        )
      ));
    $target_robot->trigger_target($target_robot, $this_ability);
    
    // Increase this robot's life energy stat
    $this_ability->recovery_options_update(array(
      'kind' => 'energy',
      'percent' => true,
      'modifiers' => false,
      'frame' => 'taunt',
      'success' => array(9, 0, 0, -9999, $target_robot->print_robot_name().'&#39;s life energy was fully restored!'),
      'failure' => array(9, 0, 0, -9999, $target_robot->print_robot_name().'&#39;s life energy was not affected&hellip;')
      ));
    $energy_recovery_amount = ceil($target_robot->robot_base_energy * ($this_ability->ability_recovery / 100));
    $target_robot->trigger_recovery($target_robot, $this_ability, $energy_recovery_amount);
    
    // Return true on success
    return true;
      
  }
  );
?>