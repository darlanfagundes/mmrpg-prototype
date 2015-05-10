<?
// ITEM : MISSILE SHARD
$ability = array(
  'ability_name' => 'Missile Shard',
  'ability_token' => 'item-shard-missile',
  'ability_game' => 'MMRPG',
  'ability_group' => 'MMRPG/Items/Missile',
  'ability_class' => 'item',
  'ability_type' => 'missile',
  'ability_description' => 'A mysterious elemental shard that radiates with the Missile type energy of a defeated support mecha.  Collect four of these items to generate a new core that can be thrown in battle to deal Missile type damage or traded in at the shop for a variable amount of Zenny.',
  'ability_energy' => 0,
  'ability_speed' => 10,
  'ability_accuracy' => 100,
  'ability_target' => 'auto',
  'ability_function' => function($objects){
    return mmrpg_ability::item_function_shard($objects);
  }
  );
?>