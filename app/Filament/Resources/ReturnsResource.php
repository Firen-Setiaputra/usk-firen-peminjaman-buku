<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReturnsResource\Pages;
use App\Filament\Resources\ReturnsResource\RelationManagers;
use App\Models\Loans;
use App\Models\Returns;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReturnsResource extends Resource
{
    protected static ?string $model = Returns::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('loans_id')
                ->label('Transaksi Peminjaman')
                ->options(
                    Loans::where('status', 'dipinjam')
                        ->get()
                        ->mapWithKeys(fn ($loans) => [
                            $loans->id => "Anggota: {$loans->anggota->nama} - Buku: {$loans->book->nama_asset}"
                        ])
                )
                ->searchable()
                ->required(),
                Forms\Components\DatePicker::make('tanggal_pengembalian')
                ->label('Tanggal Pengembalian Sebenarnya')
                ->default(now())
                ->required()
                ->maxDate(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('loans.anggota.nama')
                ->label('nama user')
                ->sortable(),
                Tables\Columns\TextColumn::make('loans.book.nama_buku')
                ->label('Nama Buku')
                ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pengembalian')
                ->label('Tanggal Pengembalian Sebenarnya')
                    ->date()
                    ->sortable(),   
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
            'index' => Pages\ListReturns::route('/'),
            'create' => Pages\CreateReturns::route('/create'),
            'edit' => Pages\EditReturns::route('/{record}/edit'),
        ];
    }
}
