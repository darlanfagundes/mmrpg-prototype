<?
// ATTACK SWAP
$ability = array(
    'ability_name' => 'Attack Swap',
    'ability_token' => 'attack-swap',
    'ability_game' => 'MMRPG',
    'ability_group' => 'MMRPG/Support/Attack',
    'ability_description' => 'The user triggers a glitch in the prototype that swaps the user\'s own attack stats with the target\'s!',
    'ability_energy' => 4,
    'ability_accuracy' => 100,
    'ability_target' => 'select_this',
    'ability_function' => function($objects){

        // Extract all objects into the current scope
        extract($objects);

        // Define this ability's attachment token
        $this_attachment_token = 'ability_'.$this_ability->ability_token;
        $this_attachment_info = array(
            'class' => 'ability',
            'ability_token' => $this_ability->ability_token,
            'ability_frame' => 0,
            'ability_frame_offset' => array('x' => 0, 'y' => 0, 'z' => -10)
            );

        // Attach this ability to the target temporarily
        $target_robot->robot_attachments[$this_attachment_token] = $this_attachment_info;
        $target_robot->update_session();

        // Target this robot's self
        $this_ability->target_options_update(array(
            'frame' => 'summon',
            'success' => array(0, 0, 10, -10, $this_robot->print_name().' triggered an '.$this_ability->print_name().' with '.$target_robot->print_name().'!')
            ));
        $this_robot->trigger_target($this_robot, $this_ability);

        // Remove this ability from the target
        unset($target_robot->robot_attachments[$this_attachment_token]);
        $target_robot->update_session();

        // If this robot happens to be targeting itself, nothing happens
        if ($this_robot->robot_id == $target_robot->robot_id){

                // Update the ability's target options and trigger
                $this_ability->target_options_update(array(
                    'frame' => 'defend',
                    'success' => array(0, 0, 0, 10, '&hellip;but nothing happened.')
                    ));
                $this_robot->trigger_target($target_robot, $this_ability, array('prevent_default_text' => true));
                return;

        }

        // Create a function that increases or decreases a robot's attack to target
        $temp_attack_function = function($this_robot, $this_ability, $temp_this_attack, $temp_target_attack){
            global $this_battle;

            // Collect the target's current attack amount
            //$temp_this_attack = $this_robot->robot_attack.'/'.$this_robot->robot_base_attack;

            //$this_battle->events_create(false, false, 'DEBUG '.__LINE__, '$temp_this_attack = '.$temp_this_attack.', $temp_target_attack = '.$temp_target_attack);

            // Only continue if this robot and the target's attack are not equal
            if ($temp_this_attack != $temp_target_attack){

                // Break apart the attack into its current and base amounts
                list($temp_attack, $temp_base_attack) = explode('/', $temp_target_attack);

                // Update this robot's values with the random data
                $this_robot->robot_attack = $temp_attack;
                $this_robot->robot_base_attack = $temp_base_attack;
                $this_robot->update_session();

                // Target this robot's self
                $is_her = in_array($this_robot->robot_token, array('roll', 'disco', 'rhythm', 'splash-woman')) ? true : false;
                $is_mecha = $this_robot->robot_class == 'mecha' ? true : false;
                $this_ability->target_options_update(array(
                    'frame' => 'defend',
                    'success' => array(9, 0, 10, -10, $this_robot->print_name().'&#39;s attack stats were modified&hellip;<br /> '.($is_her ? 'Her' : ($is_mecha ? 'Its' : 'His')).' new attack stats are '.$this_robot->print_attack().' / '.$this_robot->print_robot_base_attack().'!')
                    ));
                $this_robot->trigger_target($this_robot, $this_ability, array('prevent_default_text' => true));

            }
            // Otherwise, if the two already have equal attack amounts
            else {

                // Target this robot's self and show the ability failing
                $this_ability->target_options_update(array(
                    'frame' => 'defend',
                    'success' => array(9, 0, 0, -10, $this_robot->print_name().'&#39;s attack stats were not affected&hellip;')
                    ));
                $this_robot->trigger_target($this_robot, $this_ability, array('prevent_default_text' => true));

                // Return true on success (well, failure, but whatever)
                return true;

            }

        };

        // Collect the target's current attack amount
        $temp_this_attack = $this_robot->robot_attack.'/'.$this_robot->robot_base_attack;
        // Collect this robot's current attack amount
        $temp_target_attack = $target_robot->robot_attack.'/'.$target_robot->robot_base_attack;

        // Update this robot's attack to that of the target's
        $temp_attack_function($this_robot, $this_ability, $temp_this_attack, $temp_target_attack);
        // Update the target's attack to that of this robot
        $temp_attack_function($target_robot, $this_ability, $temp_target_attack, $temp_this_attack);

        // Return true on success
        return true;

    },
    'ability_function_onload' => function($objects){

        // Extract all objects into the current scope
        extract($objects);

        // If used by support robot OR the has a Target Module, allow opponent targetting
        $temp_support_robots = array('roll', 'disco', 'rhythm');
        if (in_array($this_robot->robot_token, $temp_support_robots)
            || $this_robot->has_item('target-module')){ $this_ability->set_target('select_target'); }
        else { $this_ability->set_target('select_this'); }

        // Return true on success
        return true;

        }
    );
?>