<?
// PUMP MAN
$robot = array(
    'robot_number' => 'DWN-074',
    'robot_game' => 'MM10',
    'robot_name' => 'Pump Man',
    'robot_token' => 'pump-man',
    'robot_image_editor' => 3842,
    'robot_image_size' => 80,
    'robot_core' => 'water',
    'robot_description' => 'Sewer Management Robot',
    'robot_energy' => 100,
    'robot_attack' => 100,
    'robot_defense' => 100,
    'robot_speed' => 100,
    'robot_weaknesses' => array('electric', 'freeze'),
    'robot_resistances' => array('flame'),
    'robot_immunities' => array('water'),
    'robot_abilities' => array(
        'water-shield',
        'buster-shot',
        'attack-boost', 'attack-break', 'attack-swap', 'attack-mode',
        'defense-boost', 'defense-break', 'defense-swap', 'defense-mode',
        'speed-boost', 'speed-break', 'speed-swap', 'speed-mode',
        'energy-boost', 'energy-break', 'energy-swap', 'energy-mode',
        'field-support', 'mecha-support',
        'light-buster', 'wily-buster', 'cossack-buster'
        ),
    'robot_rewards' => array(
        'abilities' => array(
                array('level' => 0, 'token' => 'water-shield')
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