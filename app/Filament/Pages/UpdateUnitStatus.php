<?php

namespace App\Filament\Pages;

use App\Models\Activity;
use App\Models\Location;
use App\Models\Unit;
use App\Models\UnitStatusLog;
use BackedEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class UpdateUnitStatus extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|UnitEnum|null $navigationGroup = 'Monitoring';

    protected static ?string $navigationLabel = 'Input Manual Unit';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPencilSquare;

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'input-manual-unit';

    protected string $view = 'filament.pages.update-unit-status';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'status' => 'NO INFO',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Select::make('unit_id')
                    ->label('Pilih Unit / Nomor Lambung')
                    ->options(
                        Unit::query()
                            ->where('is_active', true)
                            ->orderBy('unit_code')
                            ->pluck('unit_code', 'id')
                            ->toArray()
                    )
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required()
                    ->afterStateUpdated(function ($state, $set): void {
                        $unit = Unit::find($state);

                        if (! $unit) {
                            return;
                        }

                        $set('status', $unit->current_status);
                        $set('activity_id', $unit->current_activity_id);
                        $set('position', $unit->current_position);
                        $set('start_bd', $unit->current_start_bd);
                    }),

                Select::make('status')
                    ->label('Status Unit')
                    ->options([
                        'ON' => 'ON',
                        'BD' => 'BD / Breakdown',
                        'STB READY' => 'STB READY',
                        'STS NO OP' => 'STS NO OP',
                        'NO INFO' => 'NO INFO',
                    ])
                    ->live()
                    ->required(),

                Select::make('activity_id')
                    ->label('Aktivitas')
                    ->options(
                        Activity::query()
                            ->orderBy('name')
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Select::make('position')
                    ->label('Posisi')
                    ->options(
                        Location::query()
                            ->orderBy('name')
                            ->pluck('name', 'name')
                            ->toArray()
                    )
                    ->searchable()
                    ->preload()
                    ->nullable(),

                DateTimePicker::make('start_bd')
                    ->label('Start BD')
                    ->visible(fn ($get): bool => $get('status') === 'BD')
                    ->required(fn ($get): bool => $get('status') === 'BD'),

                Textarea::make('note')
                    ->label('Catatan')
                    ->placeholder('Contoh: input manual karena pengawas belum melakukan laporan')
                    ->rows(3)
                    ->columnSpanFull()
                    ->nullable(),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $unit = Unit::findOrFail($data['unit_id']);

        $startBd = ($data['status'] === 'BD')
            ? ($data['start_bd'] ?? now())
            : null;

        $unit->update([
            'current_status' => $data['status'],
            'current_activity_id' => $data['activity_id'] ?? null,
            'current_position' => $data['position'] ?? null,
            'current_start_bd' => $startBd,
            'last_updated_by' => Auth::id(),
            'last_updated_at' => now(),
        ]);

        UnitStatusLog::create([
            'unit_id' => $unit->id,
            'project_id' => $unit->project_id,
            'activity_id' => $data['activity_id'] ?? null,
            'status' => $data['status'],
            'position' => $data['position'] ?? null,
            'start_bd' => $startBd,
            'note' => $data['note'] ?? null,
            'updated_by' => Auth::id(),
        ]);

        Notification::make()
            ->title('Status unit berhasil diperbarui')
            ->body('PIC otomatis tercatat sebagai ' . Auth::user()?->name)
            ->success()
            ->send();

        $this->form->fill([
            'unit_id' => null,
            'status' => 'NO INFO',
            'activity_id' => null,
            'position' => null,
            'start_bd' => null,
            'note' => null,
        ]);
    }
}
