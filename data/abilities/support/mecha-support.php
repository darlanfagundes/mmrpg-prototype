<?
// MECHA SUPPORT
$ability = array(
    'ability_name' => 'Mecha Support',
    'ability_token' => 'mecha-support',
    'ability_game' => 'MMRPG',
    'ability_group' => 'MMRPG/Support/Special',
    'ability_description' => 'The user summons a familiar support mecha from their own home field to their side of the battle, allowing it to temporarily fight as part of the user\'s own team! This ability seems to work differently for Neutral and Copy Core robots...',
    'ability_energy' => 5,
    'ability_speed' => 10,
    'ability_accuracy' => 100,
    'ability_function' => function($objects){

        // Extract all objects into the current scope
        extract($objects);
        //$mmrpg_index_fields = rpg_field::get_index();

        // Update the ability's target options and trigger
        $this_ability->target_options_update(array(
            'frame' => 'summon',
            'success' => array(0, 0, 0, 10, $this_robot->print_name().' uses '.$this_ability->print_name().'!')
            ));
        $this_robot->trigger_target($target_robot, $this_ability, array('prevent_default_text' => true));

        // Only continue with the ability if player has less than 8 robots
        if (count($this_player->player_robots) < MMRPG_SETTINGS_BATTLEROBOTS_PERSIDE_MAX){

            // Place the current robot back on the bench
            $this_original_robot_id = $this_robot->robot_id;
            $this_robot->robot_frame = 'taunt';
            $this_robot->robot_position = 'bench';
            $this_player->player_frame = 'base';
            $this_player->values['current_robot'] = false;
            $this_player->values['current_robot_enter'] = false;
            $this_robot->update_session();
            $this_player->update_session();

            // Collect the current robot level for this field
            $this_robot_level = !empty($this_robot->robot_level) ? $this_robot->robot_level : 1;
            $this_field_level = !empty($this_battle->battle_level) ? $this_battle->battle_level : 1;

            // Check if this robot is a Copy Core or Elemental Core (skip if Neutral)
            global $mmrpg_index;
            $this_field_mechas = array();
            if (!empty($this_robot->robot_core)){
                if ($this_robot->robot_core == 'copy'){
                    // Collect the current robots available for this current field
                    $this_field_mechas = !empty($this_battle->battle_field->field_mechas) ? $this_battle->battle_field->field_mechas : array();
                } elseif (!empty($this_robot->robot_field)){
                    // Collect the current mechas available for this robot's home field
                    //$temp_field = !empty($mmrpg_index_fields[$this_robot->robot_field]) ? $mmrpg_index_fields[$this_robot->robot_field] : array();
                    //$this_field_info = rpg_field::parse_index_info($temp_field);
                    $this_field_info = rpg_field::get_index_info($this_robot->robot_field);
                    $this_field_mechas = !empty($this_field_info['field_mechas']) ? $this_field_info['field_mechas'] : array();
                }
            }

            // If no mechas were defined, default to the Met
            if (empty($this_field_mechas)){
                $this_field_mechas[] = 'met';
            }

            // Pull a random mecha element out of the array
            $this_mecha_count = count($this_field_mechas);
            $this_mecha_token = $this_field_mechas[0]; //$this_field_mechas[array_rand($this_field_mechas)];
            $this_mecha_name_token = preg_replace('/-([1-3]+)$/i', '', $this_mecha_token);
            if (empty($_SESSION['GAME']['values']['robot_database'][$this_mecha_token]['robot_summoned'])){ $_SESSION['GAME']['values']['robot_database'][$this_mecha_token]['robot_summoned'] = 0; }
            $this_mecha_summoned_counter = $_SESSION['GAME']['values']['robot_database'][$this_mecha_token]['robot_summoned'];

            // Check to see if this robot has summoned a mecha during this battle already
            if (!isset($this_robot->counters['ability_mecha_support'])){ $this_robot->counters['ability_mecha_support'] = 0; }
            $this_robot->update_session();

            // Based on the number of summons this battle, decide which in rotation to use
            $temp_summon_pos = $this_robot->counters['ability_mecha_support'] + 1;
            if ($this_mecha_count == 1){ $temp_summon_pos = 1; }
            elseif ($temp_summon_pos > $this_mecha_count){
                $temp_summon_pos = $temp_summon_pos % $this_mecha_count;
                if ($temp_summon_pos < 1){ $temp_summon_pos = $this_mecha_count; }
            }
            $temp_summon_key = $temp_summon_pos - 1;
            $this_mecha_token = $this_field_mechas[$temp_summon_key];

            // Update the summon flag now that we're done with it
            $this_robot->counters['ability_mecha_support'] += 1;
            $this_robot->update_session();

            // Collect database info for this mecha
            global $db;
            $this_mecha_info = rpg_robot::get_index_info($this_mecha_token);
            $this_mecha_info = rpg_robot::parse_index_info($this_mecha_info);

            // Update or create the mecha letter token
            if (!isset($this_player->counters['player_mechas'][$this_mecha_name_token])){ $this_player->counters['player_mechas'][$this_mecha_name_token] = 0; }
            else { $this_player->counters['player_mechas'][$this_mecha_name_token]++; }
            $this_player->update_session();

            // Add this robot's token to the robot database, as to unlock this robot's ability data
            if (!isset($_SESSION['GAME']['values']['robot_database'][$this_mecha_token])){ $_SESSION['GAME']['values']['robot_database'][$this_mecha_token] = array('robot_token' => $this_mecha_token); }
            if (!isset($_SESSION['GAME']['values']['robot_database'][$this_mecha_token]['robot_summoned'])){ $_SESSION['GAME']['values']['robot_database'][$this_mecha_token]['robot_summoned'] = 0; }
            $_SESSION['GAME']['values']['robot_database'][$this_mecha_token]['robot_summoned'] += 1;
            $this_mecha_summoned_counter = $_SESSION['GAME']['values']['robot_database'][$this_mecha_token]['robot_summoned'];

            // Decide which letter to attach to this mecha
            $this_letter_options = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');
            $this_mecha_letter = $this_letter_options[$this_player->counters['player_mechas'][$this_mecha_name_token]];

            // DEBUG

            // Generate the new robot and add it to this player's team
            $this_key = $this_player->counters['robots_active'] + $this_player->counters['robots_disabled'];
            $this_id = $this_player->player_id + 2 + $this_key;
            $this_id_token = $this_id.'_'.$this_mecha_info['robot_token'];
            $this_summon_statboost = $this_robot_level >= 100 ? 100 : $this_robot_level;
            $this_summon_bonusmoves = $this_robot_level >= 100 ? 3 : round(($this_robot_level / 100) * 3);
            $this_stat_basetotal = $this_mecha_info['robot_energy'] + $this_mecha_info['robot_attack'] + $this_mecha_info['robot_defense'] + $this_mecha_info['robot_speed'];
            $this_boost_abilities = array('attack-boost', 'defense-boost', 'speed-boost', 'energy-boost');
            $this_break_abilities = array('attack-break', 'defense-break', 'speed-break', 'energy-break');
            $this_extra_abilities = array_merge($this_boost_abilities, $this_break_abilities);
            shuffle($this_extra_abilities);
            $this_mecha_info['robot_id'] = $this_id;
            $this_mecha_info['robot_key'] = $this_key;
            $this_mecha_info['robot_position'] = 'active';
            $this_mecha_info['robot_name'] .= ' '.$this_mecha_letter;
            $this_mecha_info['robot_experience'] = 0;
            $this_mecha_info['robot_level'] = ceil($this_robot_level / 2);
            $this_mecha_info['values']['robot_rewards'] = array();
            $this_mecha_info['values']['robot_rewards']['robot_energy'] = ceil(($this_mecha_info['robot_energy'] / $this_stat_basetotal) * $this_summon_statboost);
            $this_mecha_info['values']['robot_rewards']['robot_attack'] = ceil(($this_mecha_info['robot_attack'] / $this_stat_basetotal) * $this_summon_statboost);
            $this_mecha_info['values']['robot_rewards']['robot_defense'] = ceil(($this_mecha_info['robot_defense'] / $this_stat_basetotal) * $this_summon_statboost);
            $this_mecha_info['values']['robot_rewards']['robot_speed'] = ceil(($this_mecha_info['robot_speed'] / $this_stat_basetotal) * $this_summon_statboost);
            $this_mecha_info['values']['robot_rewards'] = array();
            for ($i = 0; $i < $this_summon_bonusmoves; $i++){
                $extra_ability = array_shift($this_extra_abilities);
                $this_mecha_info['robot_abilities'][] = $extra_ability;
            }
            $temp_mecha = rpg_game::get_robot($this_battle, $this_player, $this_mecha_info);
            $temp_mecha->apply_stat_bonuses();
            foreach ($temp_mecha->robot_abilities AS $this_key2 => $this_token){
                $temp_abilityinfo = array('ability_token' => $this_token);
                $temp_ability = rpg_game::get_ability($this_battle, $this_player, $temp_mecha, $temp_abilityinfo);
            }
            $temp_mecha->flags['ability_startup'] = true;
            $temp_mecha->update_session();
            $this_mecha_info = $temp_mecha->export_array();
            $this_player->load_robot($this_mecha_info, $this_key);
            $this_player->update_session();

            // Automatically trigger a switch action to the new mecha support robot
            $this_battle->actions_trigger($this_player, $this_robot, $target_player, $target_robot, 'switch', $this_id_token);

            // Refresh the current robot's frame back to normal (manually because reference confusion)
            rpg_robot::set_session_field($this_original_robot_id, 'robot_frame', 'base');

        }
        // Otherwise print a nothing happened message
        else {

            // Update the ability's target options and trigger
            $this_ability->target_options_update(array(
                'frame' => 'defend',
                'success' => array(0, 0, 0, 10, '&hellip;but nothing happened.')
                ));
            $this_robot->trigger_target($target_robot, $this_ability, array('prevent_default_text' => true));

        }

        // Return true on success
        return true;

        }
    );
?>