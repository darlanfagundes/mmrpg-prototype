<?
// TIME MAN
$robot = array(
  'robot_number' => 'DLN-00A',
  'robot_game' => 'MM01',
  'robot_name' => 'Time Man',
  'robot_token' => 'time-man',
  'robot_image_editor' => 412,
  'robot_core' => 'time',
  'robot_description' => 'Prototype Time-Control Robot',
  'robot_field' => 'clock-citadel',
  'robot_energy' => 100,
  'robot_attack' => 100,
  'robot_defense' => 100,
  'robot_speed' => 100,
  'robot_weaknesses' => array('electric', 'nature'),
  'robot_immunities' => array('time'),
  'robot_abilities' => array(
  	'time-arrow', 'time-slow',
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
        array('level' => 0, 'token' => 'time-arrow'),
        array('level' => 6, 'token' => 'time-slow')
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