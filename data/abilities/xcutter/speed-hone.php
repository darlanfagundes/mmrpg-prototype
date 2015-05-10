<?
// SPEED HONE
$ability = array(
  'ability_name' => 'Speed Hone',
  'ability_token' => 'speed-hone',
  'ability_game' => 'MMRPG',
  'ability_group' => 'MMRPG/Support/01/CutterSpeed',
  'ability_description' => 'The user powers up its own mobility systems using an effecient blades program, raising speed by {RECOVERY}%!',
  'ability_energy' => 4,
  'ability_recovery' => 10,
  'ability_recovery_percent' => true,
  'ability_type' => 'cutter',
  'ability_accuracy' => 100,
  'ability_function' => function($objects){

    // Call the common elemental stat boost function from here
    return mmrpg_ability::ability_function_elemental_speed_boost($objects, 'sharpened', 'dulled');

    },
  'ability_function_onload' => function($objects){

    // Call the common elemental stat boost onload function from here
    return mmrpg_ability::ability_function_onload_elemental_speed_boost($objects);

    }
  );
?>