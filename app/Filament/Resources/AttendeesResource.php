<?php /** @noinspection ALL */

namespace App\Filament\Resources;

use App\Filament\Resources\AttendeesResource\Pages;
use App\Filament\Resources\AttendeesResource\RelationManagers;
use App\Models\Attendees;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Notifications\SmsCodeNotification;

class AttendeesResource extends Resource
{
    protected static ?string $model = Attendees::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->label('First Name')
                    ->autocapitalize('words')
                    ->required()
                    ->maxLength(255)
                    ->live(),
                Forms\Components\TextInput::make('last_name')
                    ->label('Last Name')
                    ->autocapitalize('words')
                    ->required()
                    ->maxLength(255)
                    ->live(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(function (Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $component) {
                        $livewire->validateOnly($component->getStatePath());
                    }),
                Forms\Components\TextInput::make('mobile')
                    ->prefix('+63')
                    ->regex("/^[0-9]+$/")
                    ->minLength(10)
                    ->maxLength(10)
                    ->live()
                    ->afterStateUpdated(function (Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $component) {
                        $livewire->validateOnly($component->getStatePath());
                    }),
                Forms\Components\TextInput::make('job_title')
                    ->label('Job Title')
                    ->autocapitalize('words')
                    ->maxLength(255)
                    ->live(),
                Forms\Components\TextInput::make('company_name')
                    ->label('Company Name')
                    ->autocapitalize('words')
                    ->maxLength(255)
                    ->live(),
                Forms\Components\TextInput::make('attendee_code')
                    ->label('Attendee Code')
                    ->unique(ignoreRecord: true)
                    ->maxLength(4)
                    ->live()
                    ->afterStateUpdated(function (Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $component) {
                        $livewire->validateOnly($component->getStatePath());
                    }),
                Forms\Components\TextInput::make('status_code')
                    ->label('Status')
                    ->maxLength(255)
                    ->live(),
                Forms\Components\Toggle::make('pre_listed')
                    ->inline()
                    ->live(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->defaultSort('id','desc')
            ->persistFiltersInSession()
            ->deselectAllRecordsWhenFiltered(false)
            ->columns([
                Tables\Columns\TextColumn::make('attendee_code')
                    ->label('Code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->label('First Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Last Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_title')
                    ->label('Job Title')
                    ->words(5)
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Company')
                    ->words(5)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_code')
                    ->label('Status')
                    ->searchable(),
                Tables\Columns\IconColumn::make('pre_listed')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\ACtions\Action::make('Send Code')
                    ->action(function(Attendees $record){
                        dd($record->notify(new SmsCodeNotification("Welcome to Raemulan Lands Inc! Join us for {$record->title} on August 9, 2024 in {$record->place}. Your check-in pass code is: {$record->attendee_code}. Excited to meet and host you at the event!")));
                    }),
                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ], position: ActionsPosition::BeforeCells)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAttendees::route('/'),
        ];
    }
}
