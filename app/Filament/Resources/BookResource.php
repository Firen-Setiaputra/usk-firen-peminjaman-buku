<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-s-book-open';
    protected static ?string $navigationLabel = 'Buku';

    protected static ?string $pluralModelLabel = 'Daftar Buku';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_buku')
                ->required()
                ->maxLength(6) // Batasi maksimal 6 karakter
                ->unique(table: 'books', column: 'kode_buku')
                ->label('Kode Buku'),
                Forms\Components\TextInput::make('nama_buku')
                ->label('Judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('penulis')
                ->label('Penulis')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('penerbit')
                ->label('Penerbit')
                    ->maxLength(255)
                    ->required(),
                    Forms\Components\Select::make('kategori')
                    ->label('Kategori')
                    ->required()
                    ->options([
                        'novel' => 'novel',
                        'cerita-anak' => 'cerita-anak',
                        'manga' => 'manga',
                        'lainnya' => 'lainnya',
                    ]),
                Forms\Components\TextInput::make('stock')
                    ->label('Stok')
                    ->placeholder('jumlah buku')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi')
                    ->columnSpanFull(),
                    Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'tersedia' => 'tersedia',
                        'rusak' => 'rusak',
                        'dipinjam' => 'dipinjam',
                    ])->default('tersedia'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_buku')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_buku')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('penulis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('penerbit')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('kategori'),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'tersedia' => 'success',
                        'rusak' => 'warning',
                        'dipinjam' => 'primary',
                    ]),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
