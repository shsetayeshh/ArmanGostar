<?php

namespace App\Filament\Resources;

use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('عنوان دوره (مثل: برنامه‌نویسی)'),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->label('آدرس انگلیسی دوره (مثل: programming)')
                    ->unique(ignoreRecord: true)
                    ->hint('فقط حروف انگلیسی کوچک و خط تیره. این آدرس تو مرورگر نشون داده میشه.'),

                Forms\Components\TextInput::make('workshop_number')
                    ->required()
                    ->maxLength(255)
                    ->label('شماره کارگاه (مثل: کارگاه ۰۱)'),

                Forms\Components\TextInput::make('capacity')
                    ->numeric()
                    ->label('ظرفیت دوره')
                    ->default(0),
                Forms\Components\TextInput::make('capacity')
                    ->numeric()
                    ->label('ظرفیت دوره')
                    ->default(0),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('courses')
                    ->label('تصویر دوره')
                    ->imageEditor()
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('is_active')
                    ->label('وضعیت فعال بودن دوره')
                    ->default(true),

                Forms\Components\Toggle::make('is_active')
                    ->label('وضعیت فعال بودن دوره')
                    ->default(true),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('توضیحات دوره')
                    ->columnSpanFull(),

                Forms\Components\Repeater::make('items')
                    ->label('سرفصل‌ها و حرفه‌ها')
                    ->simple(
                        Forms\Components\TextInput::make('item')
                            ->required()
                            ->label('عنوان سرفصل')
                            ->placeholder('مثلاً: لاراول مقدماتی')
                    )
                    ->createItemButtonLabel('اضافه کردن سرفصل جدید')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('تصویر')
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان دوره')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('آدرس'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('وضعیت'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ساخت')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('ویرایش'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('حذف انتخاب شده‌ها'),
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
            'index' => \App\Filament\Resources\CourseResource\Pages\ListCourses::route('/'),
            'create' => \App\Filament\Resources\CourseResource\Pages\CreateCourse::route('/create'),
            'edit' => \App\Filament\Resources\CourseResource\Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
