<?
// SPACE OVERDRIVE
$ability = array(
    'ability_name' => 'Space Overdrive',
    'ability_token' => 'space-overdrive',
    'ability_game' => 'MMRPG',
    'ability_group' => 'MMRPG/Weapons/16/Space',
    'ability_description' => 'The user releases all of their stored weapon energy at once in a powerful storm of cosmic shots, dealing Space type damage to all targets on the opponent\'s side of the field.  This ability\'s power is directly proportionate to the amount of life energy the user has lost, making it most effective when used in critical condition.',
    'ability_type' => 'space',
    'ability_energy' => 10,
    'ability_energy_percent' => true,
    'ability_accuracy' => 100,
    'ability_function' => function($objects){

        // Call the common overdrive function from here
        return rpg_ability::ability_function_overdrive($objects, 'cosmic', 'discorded', 'harmonized');

        },
    'ability_function_onload' => function($objects){

        // Call the common overdrive onload function from here
        return rpg_ability::ability_function_onload_overdrive($objects);

        }
    );
?>