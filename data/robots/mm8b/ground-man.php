<?
// GROUND MAN
$robot = array(
    'robot_number' => 'KGN-003',
    'robot_game' => 'MM085',
    'robot_name' => 'Ground Man',
    'robot_token' => 'ground-man',
    'robot_core' => 'earth',
    'robot_description' => 'Underground Drilling Robot',
    'robot_energy' => 100,
    'robot_attack' => 100,
    'robot_defense' => 100,
    'robot_speed' => 100,
    'robot_weaknesses' => array('explode', 'crystal'),
    'robot_resistances' => array('earth', 'swift'),
    'robot_abilities' => array(
        'spread-drill',
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
                array('level' => 0, 'token' => 'spread-drill')
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