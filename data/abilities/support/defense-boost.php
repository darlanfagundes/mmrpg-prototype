<?
// DEFENSE BOOST
$ability = array(
    'ability_name' => 'Defense Boost',
    'ability_token' => 'defense-boost',
    'ability_game' => 'MMRPG',
    'ability_group' => 'MMRPG/Support/Defense',
    'ability_description' => 'The user optimizes internal systems to improve shields and raise defense by up to {RECOVERY}%!',
    'ability_energy' => 4,
    'ability_recovery' => 33,
    'ability_recovery_percent' => true,
    'ability_accuracy' => 100,
    'ability_function' => function($objects){

        // Extract all objects into the current scope
        extract($objects);

        // Target this robot's self
        $this_ability->target_options_update(array(
            'frame' => 'summon',
            'success' => array(0, 0, 10, -10, $this_robot->print_name().' uses '.$this_ability->print_name().'!')
            ));
        $this_robot->trigger_target($this_robot, $this_ability);

        // If this ability is being used by a special support robot that allows targetting
        if ($this_robot->player_id == $target_robot->player_id){

            // Increase this robot's defense stat
            $this_ability->recovery_options_update(array(
                'kind' => 'defense',
                'percent' => true,
                'frame' => 'taunt',
                'success' => array(0, -2, 0, -10, $target_robot->print_name().'&#39;s shields powered up!'),
                'failure' => array(9, -2, 0, -10, $target_robot->print_name().'&#39;s shields were not affected&hellip;')
                ));
            $defense_recovery_amount = ceil($target_robot->robot_defense * ($this_ability->ability_recovery / 100));
            $target_robot->trigger_recovery($target_robot, $this_ability, $defense_recovery_amount);

        }
        // Otherwise if targetting a team mate
        else {

            // Increase the target robot's defense stat
            $this_ability->recovery_options_update(array(
                'kind' => 'defense',
                'percent' => true,
                'frame' => 'taunt',
                'success' => array(0, -2, 0, -10, $this_robot->print_name().'&#39;s shields powered up!'),
                'failure' => array(9, -2, 0, -10, $this_robot->print_name().'&#39;s shields were not affected&hellip;')
                ));
            $defense_recovery_amount = ceil($this_robot->robot_defense * ($this_ability->ability_recovery / 100));
            $this_robot->trigger_recovery($this_robot, $this_ability, $defense_recovery_amount);

        }

        // Return true on success
        return true;

    },
    'ability_function_onload' => function($objects){

        // Extract all objects into the current scope
        extract($objects);

        // If used by support robot OR the has a Target Module, allow bench targetting
        $temp_support_robots = array('roll', 'disco', 'rhythm');
        if (in_array($this_robot->robot_token, $temp_support_robots)
            || $this_robot->has_item('target-module')){ $this_ability->set_target('select_this'); }
        else { $this_ability->reset_target(); }

        // Return true on success
        return true;

        }
    );
?>