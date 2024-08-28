<?php /** @noinspection ALL */

namespace App\Filament\Resources;

use App\Filament\Resources\AttendeesResource\Pages;
use App\Filament\Resources\AttendeesResource\RelationManagers;
use App\Models\Attendees;
use App\Models\EventsTable;
use App\Models\Status;
use App\Models\Events;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Notifications\SmsCodeNotification;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Imports\AttendeesImporter;
use App\Filament\Exports\AttendeesExporter;
use App\Mail\VerificationCodeMail;
use App\Models\Group;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Get;

class AttendeesResource extends Resource
{
    protected static ?string $model = Attendees::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Toggle::make('pre_listed')
                            ->inline(false)
                            ->live()
                            ->columnSpan(1),
//                        Forms\Components\TextInput::make('attendee_code')
//                            ->label('Attendee Code')
//                            ->helperText('generated upon registration')
//                            ->unique(ignoreRecord: true)
//                            ->maxLength(4)
//                            ->live()
//                            ->afterStateUpdated(function (Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $component) {
//                                $livewire->validateOnly($component->getStatePath());
//                            })
//                            ->readOnly()
//                            ->columnSpan(4),
                        Forms\Components\Select::make('status_code')
                            ->label('Status')
                            ->native(false)
                            ->relationship(name: 'status', titleAttribute: 'description')
                            ->columnSpan(3),
                        Forms\Components\Select::make('event_code')
                            ->label('Event')
                            ->native(false)
                            ->relationship(name: 'event', titleAttribute: 'description')
                            ->live(onBlur: true)
                            ->columnSpan(4),

                        Forms\Components\Select::make('table_code')
                            ->label('Table')
                            ->native(false)
                            ->options(function (Get $get) {
                                return EventsTable::where('event_code', $get('event_code'))
                                    ->get()
                                    ->pluck('description', 'description');
                            })
                            ->columnSpan(4),


                    ])->columns(12)->columnSpanfull(),
                Forms\Components\TextInput::make('full_name')
                    ->label('Full Name')
                    ->autocapitalize('words')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->columnSpan(4),
                Forms\Components\Select::make('group_code')
                    ->label('Group')
                    ->native(false)
                    ->relationship(name: 'group', titleAttribute: 'code')
                    ->columnSpan(4)
                    ->live(onBlur: true),
                Forms\Components\TextInput::make('other_group_name')
                    ->label('Other Group Name')
                    ->columnSpan(4)
                    ->hidden(fn (Get $get): bool => $get('group_code')!='OTH'),
//                Forms\Components\TextInput::make('first_name')
//                    ->label('First Name')
//                    ->autocapitalize('words')
//                    ->required()
//                    ->maxLength(255)
//                    ->live()
//                    ->columnSpan(4),
//                Forms\Components\TextInput::make('last_name')
//                    ->label('Last Name')
//                    ->autocapitalize('words')
//                    ->required()
//                    ->maxLength(255)
//                    ->live()
//                    ->columnSpan(4),
//                Forms\Components\TextInput::make('job_title')
//                    ->label('Job Title')
//                    ->autocapitalize('words')
//                    ->maxLength(255)
//                    ->live()
//                    ->columnSpan(4),
//                Forms\Components\TextInput::make('email')
//                    ->email()
//                    ->unique(ignoreRecord: true)
//                    ->maxLength(255)
//                    ->live()
//                    ->afterStateUpdated(function (Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $component) {
//                        $livewire->validateOnly($component->getStatePath());
//                    })
//                    ->columnSpan(4),
                Forms\Components\TextInput::make('mobile')
                    ->required()
                    ->prefix('+63')
                    ->regex("/^[0-9]+$/")
                    ->minLength(10)
                    ->maxLength(10)
                    ->live()
                    ->afterStateUpdated(function (Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $component) {
                        $livewire->validateOnly($component->getStatePath());
                    })
                    ->columnSpan(4),
//
//                Forms\Components\TextInput::make('company_name')
//                    ->label('Company Name')
//                    ->autocapitalize('words')
//                    ->maxLength(255)
//                    ->live()
//                    ->columnSpan(4),

            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->defaultSort('id','desc')
            ->persistFiltersInSession()
            ->deselectAllRecordsWhenFiltered(false)
            ->columns([
                Tables\Columns\TextColumn::make('event.description')
                    ->label('Event')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status.description')
                    ->label('Status')
                    ->searchable(),
                Tables\Columns\IconColumn::make('pre_listed')
                    ->boolean(),
                Tables\Columns\TextColumn::make('attendee_group')
                    ->label('Group')
                    ->searchable(),
                Tables\Columns\TextColumn::make('table_code')
                    ->label('Table')
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable(),
//                Tables\Columns\TextColumn::make('first_name')
//                    ->label('First Name')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('last_name')
//                    ->label('Last Name')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('company_name')
//                    ->label('Company')
//                    ->words(5)
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('job_title')
//                    ->label('Job Title')
//                    ->words(5)
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('email')
//                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->searchable(),


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
            ->headerActions([
                ImportAction::make()
                    ->importer(AttendeesImporter::class),
                ExportAction::make()
                    ->exporter(AttendeesExporter::class),
            ])
            ->actions([
//                Tables\ACtions\Action::make('Send Code')
//                    ->action(function(Attendees $record){
//                        $record->generateUniqueCode();
//                        $record->notify(new SmsCodeNotification($record));
////                        Mail::to($record->email)->send(new VerificationCodeMail($record));
//                    }),
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
