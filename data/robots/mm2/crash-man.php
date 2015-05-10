<?
// CRASH MAN
$robot = array(
  'robot_number' => 'DWN-013',
  'robot_game' => 'MM02',
  'robot_name' => 'Crash Man',
  'robot_token' => 'crash-man',
  'robot_image_editor' => 412,
  'robot_core' => 'explode',
  'robot_description' => 'Aggressive Bomber Robot',
  'robot_field' => 'pipe-station',
  'robot_energy' => 100,
  'robot_attack' => 100,
  'robot_defense' => 100,
  'robot_speed' => 100,
  'robot_weaknesses' => array('wind', 'shield'),
  'robot_resistances' => array('explode', 'cutter'),
  'robot_abilities' => array(
  	'crash-bomber',
  	'buster-shot',
  	'attack-boost', 'attack-break', 'attack-swap', 'attack-mode',
  	'defense-boost', 'defense-break', 'defense-swap', 'defense-mode',
    'speed-boost', 'speed-break', 'speed-swap', 'speed-mode',
    'energy-boost', 'energy-break', 'energy-swap', 'repair-mode',
    'field-support', 'mecha-support',
    'light-buster', 'wily-buster', 'cossack-buster'
    ),
  'robot_rewards' => array(
    'abilities' => array(
        array('level' => 0, 'token' => 'buster-shot'),
        array('level' => 0, 'token' => 'crash-bomber'),
        //array('level' => 6, 'token' => 'crash-driller'),
        //array('level' => 10, 'token' => 'crash-avenger')
      )
    ),
  'robot_quotes' => array(
    'battle_start' => '',
    'battle_taunt' => '',
    'battle_victory' => '',
    'battle_defeat' => ''
    )
  );
?>