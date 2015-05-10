<?
// FIRE CHASER
$ability = array(
  'ability_name' => 'Fire Chaser',
  'ability_token' => 'fire-chaser',
  'ability_game' => 'MM01',
  'ability_description' => 'The user a unleashes a powerful wave of fire that chases the target, inflicting twice as much damage on slower targets but half as much on faster ones&hellip;',
  'ability_type' => 'flame',
  'ability_type2' => 'swift',
  'ability_energy' => 8,
  'ability_damage' => 24,
  'ability_accuracy' => 94,
  'ability_function' => function($objects){
    
    // Extract all objects into the current scope
    extract($objects);
    
    // Target the opposing robot
    $this_ability->target_options_update(array(
      'frame' => 'shoot',
      'success' => array(0, 100, 0, 10, $this_robot->print_robot_name().' unleashes a '.$this_ability->print_ability_name().'!'),
      ));
    $this_robot->trigger_target($target_robot, $this_ability);
    
    // Inflict damage on the opposing robot
    $this_ability->damage_options_update(array(
      'kind' => 'energy',
      'kickback' => array(15, 0, 0),
      'success' => array(1, -75, 0, 10, 'The '.$this_ability->print_ability_name().' chased the target!'),
      'failure' => array(1, -100, 0, -10, 'The '.$this_ability->print_ability_name().' missed&hellip;')
      ));
    $this_ability->recovery_options_update(array(
      'kind' => 'energy',
      'frame' => 'taunt',
      'kickback' => array(0, 0, 0),
      'success' => array(1, -75, 0, 10, 'The '.$this_ability->print_ability_name().' ignited the target!'),
      'failure' => array(1, -100, 0, -10, 'The '.$this_ability->print_ability_name().' had no effect&hellip;')
      ));
    if ($this_robot->robot_speed < $target_robot->robot_speed){ $speed_multiplier = 0.5; }
    elseif ($this_robot->robot_speed > $target_robot->robot_speed){ $speed_multiplier = 2.0; }
    else { $speed_multiplier = 1; }
    $energy_damage_amount = ceil($this_ability->ability_damage * $speed_multiplier);
    $target_robot->trigger_damage($this_robot, $this_ability, $energy_damage_amount);
    // Return true on success
    return true;
      
    }
  );
?>