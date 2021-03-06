<?
// PROTOTYPE BATTLE 5 : VS BONUS FIELD 1
$battle = array(
  'battle_name' => 'Bonus Chapter Mecha Battle',
  'battle_size' => '1x4',
  'battle_encore' => true,
  'battle_counts' => false,
  'battle_description' => 'You\'ve completed the MMRPG Prototype! Thanks for playing to the end! :D',
  'battle_level' => 30,
  'battle_turns' => 24,
  'battle_points' => 60000,
  'battle_field_base' => array('field_id' => 1000, 'field_token' => 'prototype-complete'),
  'battle_target_player' => array(
    'player_id' => MMRPG_SETTINGS_TARGET_PLAYERID,
    'player_token' => 'player',
    'player_switch' => 2,
    'player_robots' => array(

      // DEFAULT SUPPORT MECHAS
      array('robot_id' => (MMRPG_SETTINGS_TARGET_PLAYERID + 1), 'robot_token' => 'met', 'robot_level' => 30)

      ),
    'player_quotes' => array(
      'battle_start' => 'They\'re not very strong, but they\'re all I have at the moment...',
      'battle_taunt' => 'Please don\'t hurt any more of my robots...',
      'battle_victory' => 'I... I can\'t believe we made it! Great work, robots!',
      'battle_defeat' => 'I have nothing left to fight with...'
      )
    ),
  'battle_rewards' => array(
    'abilities' => array(
      array('token' => 'mecha-support')
      )
    )
  );
?>