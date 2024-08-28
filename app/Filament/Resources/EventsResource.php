<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventsResource\Pages;
use App\Filament\Resources\EventsResource\RelationManagers;
use App\Models\Events;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Repeater;

class EventsResource extends Resource
{
    protected static ?string $model = Events::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Admin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Group::make()->schema([
                    Repeater::make('eventTables')
                        ->relationship()
                        ->schema([
                            TextInput::make('description')
                                ->required()
                                ->columnSpan(8)
                                ->maxLength(255)
                                ->distinct(),
                            TextInput::make('capacity')
                                ->columnSpan(4)
                                ->required(),

                        ])->addActionLabel('Add Table')
                        ->collapsible(true)
                        ->itemLabel(fn (array $state): ?string => $state['description'] ?? null)
                        ->columns(12)
                        ->columnSpanFull()
                ])
                ->columns(12)
                ->columnSpan(6),
                Group::make()->schema([
                    Forms\Components\TextInput::make('code')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(4)
                        ->columnSpan(3),
                    Forms\Components\TextInput::make('description')
                        ->label('Name')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255)
                        ->columnSpan(9),

                    Forms\Components\Actions::make([
                        Action::make('vip')
                            ->label('VIP Registration')
                            ->url(fn (Get $get): string => route('vip-register', ['enc_id' =>Crypt::encrypt($get('id'))]))
                            ->openUrlInNewTab(),
                        Action::make('VIP QR')
                            ->label('VIP QR')
                            ->fillForm(fn(Get $get) => [
                                'qr-options' => \LaraZeus\Qr\Facades\Qr::getDefaultOptions(),
                                'qr-data' => route('vip-register', ['enc_id' =>Crypt::encrypt($get('id'))]),
                            ])
                            ->form(\LaraZeus\Qr\Facades\Qr::getFormSchema('qr-data', 'qr-options'))
                            ->action(function() {
                            }),
                        Action::make('checkin')
                            ->label('Check-In')
                            ->url(fn (Get $get): string => route('check-in', ['enc_id' =>Crypt::encrypt($get('id'))]))
                            ->openUrlInNewTab(),
                        Action::make('Check-In QR')
                            ->label('Check-In QR')
                            ->fillForm(fn(Get $get) => [
                                'qr-options' => \LaraZeus\Qr\Facades\Qr::getDefaultOptions(),
                                'qr-data' => route('check-in', ['enc_id' =>Crypt::encrypt($get('id'))]),
                            ])
                            ->form(\LaraZeus\Qr\Facades\Qr::getFormSchema('qr-data', 'qr-options'))
                            ->action(function() {
                            }),
                        Action::make('register')
                            ->label('Register')
                            ->url(fn (Get $get): string => route('register', ['enc_id' =>Crypt::encrypt($get('id'))]))
                            ->openUrlInNewTab(),
                        Action::make('Register QR')
                            ->label('Register QR')
                            ->fillForm(fn(Get $get) => [
                                'qr-options' => \LaraZeus\Qr\Facades\Qr::getDefaultOptions(),
                                'qr-data' => route('register', ['enc_id' =>Crypt::encrypt($get('id'))]),
                            ])
                            ->form(\LaraZeus\Qr\Facades\Qr::getFormSchema('qr-data', 'qr-options'))
                            ->action(function() {
                            }),
                    ])->verticalAlignment(VerticalAlignment::End)->columns(12)->columnSpanFull(),
                    // Placeholder::make('attendees')
                    //             ->columnSpanFull()
                    //             ->content(function (Get $get, $state, $record): HtmlString {
                    //                 $attendees = $record->attendees()->get();

                    //                 $html = '<table border="1" cellpadding="5" cellspacing="0" class="table w-full">';
                    //                 $html .= '<thead>';
                    //                 $html .= '<tr>';
                    //                 $html .= '<th>Prelisted</th>';
                    //                 $html .= '<th>Status</th>';
                    //                 $html .= '<th>Full Name</th>';
                    //                 $html .= '<th>Group</th>';
                    //                 $html .= '</tr>';
                    //                 $html .= '</thead>';
                    //                 $html .= '<tbody>';

                    //                 foreach ($attendees as $attendee) {
                    //                     $html .= '<tr>';
                    //                     $html .= '<td>' . ($attendee->pre_listed ? 'Yes' : 'No') . '</td>';
                    //                     $html .= '<td>' . $attendee->status->description . '</td>';
                    //                     $html .= '<td>' . $attendee->full_name . '</td>';
                    //                     $html .= '<td>' . ($attendee->group ? $attendee->group->code : 'N/A') . '</td>';
                    //                     $html .= '</tr>';
                    //                 }

                    //                 $html .= '</tbody>';
                    //                 $html .= '</table>';

                    //                 return new HtmlString($html);
                    //             }),
                ])
                ->columns(12)
                ->columnSpan(6),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
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
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalWidth(MaxWidth::SevenExtraLarge),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('qr-code')
                    ->fillForm(fn(Events $record) => [
                        'qr-options' => \LaraZeus\Qr\Facades\Qr::getDefaultOptions(),// or $record->qr-options
                        'qr-data' => route('vip-register', ['enc_id' => Crypt::encrypt($record->id)]),// or $record->url
                    ])
                    ->form(\LaraZeus\Qr\Facades\Qr::getFormSchema('qr-data', 'qr-options'))
                    ->action(function(){}),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEvents::route('/'),
        ];
    }
}
