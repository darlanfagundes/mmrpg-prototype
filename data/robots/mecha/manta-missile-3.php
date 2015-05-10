<?
// MANTA MISSILE III
$robot = array(
  'robot_number' => 'MANT-003', // ROBOT : MANTA MISSILE (3rd Gen)
  'robot_class' => 'mecha',
  'robot_game' => 'MM04',
  'robot_name' => 'Manta Missile',
  'robot_token' => 'manta-missile-3',
  'robot_image_editor' => 412,
  'robot_core' => 'missile',
  'robot_field' => 'submerged-armory',
  'robot_description' => 'Homing Mantaray Mecha',
  'robot_energy' => 100,
  'robot_attack' => 100,
  'robot_defense' => 100,
  'robot_speed' => 100,
  'robot_weaknesses' => array('wind', 'space', 'shadow'),
  'robot_resistances' => array('missile', 'earth'),
  'robot_abilities' => array('manta-seeker'),
  'robot_rewards' => array(
    'abilities' => array(
        array('level' => 0, 'token' => 'manta-seeker')
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