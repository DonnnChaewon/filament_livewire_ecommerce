<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AddressRelationManager extends RelationManager {
    protected static string $relationship = 'address';

    public function form(Form $form): Form {
        return $form
            ->schema([
                TextInput::make('first_name')->maxLength(255)->required(),
                TextInput::make('last_name')->maxLength(255),
                TextInput::make('phone')->tel()->maxLength(20)->required(),
                TextInput::make('city')->maxLength(255)->required(),
                TextInput::make('state')->maxLength(255)->required(),
                TextInput::make('zip_code')->maxLength(10)->required(),
                Textarea::make('street_address')->maxLength(255)->required(),
            ]);
    }

    public function table(Table $table): Table {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('full_name')->label('Full Name'),
                TextColumn::make('phone'),
                TextColumn::make('city'),
                TextColumn::make('state'),
                TextColumn::make('zip_code'),
                TextColumn::make('street_address')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}