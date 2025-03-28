<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\School;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('user_id')
                    ->label('User ID')
                    ->required()
                    ->default(fn(): string => (string) User::generateId())
                    ->disabled() // Disable when updating a user
                    ->placeholder('123456'),
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->placeholder('John Doe'),
                TextInput::make('email')
                    ->email()
                    ->label('Email')
                    ->required()
                    ->maxLength(255)
                    ->unique(User::class, 'email', ignoreRecord: true),
                Select::make('role')
                    ->label('Role')
                    ->options([
                        'super' => 'super',
                        'admin' => 'admin',
                        'parent' => 'parent',
                        'teacher' => 'teacher',
                        'guardian' => 'guardian',
                    ])
                    ->required(),
                TextInput::make('password')
                    ->label('Password')
                    ->required(fn(string $operation): bool => $operation === 'create') // Only required when creating a user
                    ->password()
                    ->confirmed()
                    ->minLength(8),
                TextInput::make('firebaseUid')
                    ->label('Firebase UID')
                    ->disabled() // Rempli automatiquement par l'API
                    ->dehydrated(false), // Ne pas sauvegarder ce champ manuellement
                TextInput::make('phone')
                    ->label('Phone')
                    ->placeholder('1234567890'),
                TextInput::make('address')
                    ->label('Address')
                    ->placeholder('123 Main St'),
                Select::make('school_ids')
                    ->label('Schools')
                    ->options(fn(): array => School::all()->pluck('name', '_id')->toArray())
                    ->multiple()
                    ->relationship('schools', 'name')
                    ->placeholder('Select schools'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->label('User ID')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('firebaseUid')
                    ->label('Firebase UID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->limit(50), // Limiter l'affichage pour éviter une colonne trop large
                Tables\Columns\TextColumn::make('schools._id')
                    ->label('Schools')
                    ->searchable()
                    ->sortable()
                    ->listWithLineBreaks()
                    ->limitList(3),
                Tables\Columns\TextColumn::make('createdAt')
                    ->label('Created At')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('updatedAt')
                    ->label('Updated At')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
