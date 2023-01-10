---
title: Eloquent
description:
extends: _layouts.documentation
section: content
updatedAt: 2022-12-31
---
## Databases
- ✋ Do not use SQLite if:
  - you are using JSON fields
  - require exact float value calculations based on decimal fields
  - have table alterations in your migrations
  - if you have raw queries which manipulate dates

## Queries
- ✋ Always write queries based on models.
- ✋ Queries can be optimized using various methods like `toBase()`, etc.
- ✋ Don't use model attributes for filtering, instead use where clauses or for complex queries scopes.
- ✋ Don't use the `update()` or mass manipulation methods, as they do not trigger model events to be thrown.

## Factories
- to be added

## Migrations

- ✋ Migrations should use `came_case` fields.
- ✋ Migrations should have fields organized into three sections (separated by a blank line):
  - primary and foreign keys, each in alphabetical order of the field name.
  - date, datetime, timestamp, and softDelete fields, in alphabetical order of the field name.
  - content fields, in alphabetical order of the field name.
- ✋ Each table should have its own migration file.
- 🤔 Migrations should only change the database schema, and not manipulate data, unless directly necessary for the migration to run.
- ✋ Migrations should contain the definitive table definition in the up method, and only drop the table in the down method.
- 🤔 Migrations should not be used to alter database structures, as this will prevent testing using in-memory SQLite databases. (See Seeders for this.)

## Primary Keys
- ✋ All primary keys should be defined as `$table->id();` or `$table->uuid()->primary();`.

## Foreign Keys
- ✋ Foreign keys should be set on all fields that refer to another table.
- ✋ Foreign key fields should be defined as `$table->foreignIdFrom(Model::class)`. Try to avoid manually naming the FK, instead let Laravel generate the name. This ensures consistent and predictable naming across the board.

### onDelete()
- ✋ Use `CASCADE` when the current table record should be deleted if the referring record is deleted.
- ✋ Use `SET NULL` when the current table record should be preserved, even if the referring record is deleted. If the foreign key field is nullable you should use `SET NULL`.
- ✋ Use `RESTRICT` when the deletion of the referring record should be prevented if the current record exists.

### onUpdate()
- ✋ This should almost always be set to `CASCADE`, meaning if the primary key of the referring record changes, this foreign key will update to retain the relationship.

## Seeders
- ✋ Never reference other records by their primary key, if the key is not semantic.
- ✋ Always seed only one model per seeder.
- ✋ Always use models to seed, so that any reactivity in Laravel can be triggered.
- ✋ Write seeders to only seed if the record does not already exist, so that seeders can be run multiple times without error.
