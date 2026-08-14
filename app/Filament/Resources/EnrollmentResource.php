<?php

namespace App\Filament\Resources;

use App\Models\Enrollment;
use App\Models\Course;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'مدیریت ثبت‌نام‌ها';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('کاربر')
                    ->relationship('user', 'name')
                    ->disabled() // ادمین نبینه کاربر رو عوض کنه
                    ->required(),
                    
                Forms\Components\Select::make('course_id')
                    ->label('دوره')
                    ->relationship('course', 'title')
                    ->disabled() // ادمین نبینه دوره رو عوض کنه
                    ->required(),

                // اطلاعات فرم مشاوره (غیرفعال تا ادمین نتونه عوض کنه، فقط برای نمایشه)
                Forms\Components\TextInput::make('name')
                    ->label('نام مشتری در فرم')
                    ->disabled(),
                Forms\Components\TextInput::make('phone')
                    ->label('شماره تماس در فرم')
                    ->disabled(),
                Forms\Components\TextInput::make('age')
                    ->label('سن در فرم')
                    ->disabled()
                    ->numeric(),
                Forms\Components\TextInput::make('referral')
                    ->label('نحوه آشنایی')
                    ->disabled(),

                Forms\Components\ToggleButtons::make('status')
                    ->label('وضعیت درخواست')
                    ->options([
                        'consultation' => 'درخواست مشاوره',
                        'pending_registration' => 'ثبت نام قطعی (در انتظار تایید)',
                        'approved' => 'تایید شده',
                        'rejected' => 'رد شده',
                    ])
                    ->colors([
                        'consultation' => 'info',
                        'pending_registration' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    ])
                    ->inline()
                    ->required(),

                Forms\Components\ToggleButtons::make('payment_status')
                    ->label('وضعیت پرداخت')
                    ->options([
                        'unpaid' => 'پرداخت نشده',
                        'partial' => 'اقساطی',
                        'paid' => 'تسویه شده',
                    ])
                    ->colors([
                        'unpaid' => 'warning',
                        'partial' => 'info',
                        'paid' => 'success',
                    ])
                    ->inline()
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label('مبلغ پرداختی (تومان)')
                    ->numeric()
                    ->default(0),

                Forms\Components\Textarea::make('admin_note')
                    ->label('یادداشت مدیریت (اختیاری)')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('نام کاربر')->searchable(),
                Tables\Columns\TextColumn::make('course.title')->label('دوره')->searchable(),
                
                // اطلاعات فرم مشاوره که الان اضافه شدن
                Tables\Columns\TextColumn::make('name')->label('نام مشتری تو فرم')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('شماره تماس')->searchable(),
                Tables\Columns\TextColumn::make('age')->label('سن'),
                Tables\Columns\TextColumn::make('referral')->label('آشنایی از طریق'),
                
                // وضعیت‌ها با ترجمه کامل فارسی
                Tables\Columns\BadgeColumn::make('status')
                    ->label('وضعیت درخواست')
                    ->colors([
                        'gray' => 'consultation',
                        'warning' => 'pending_registration',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'consultation' => 'مشاوره',
                        'pending_registration' => 'در انتظار تایید',
                        'approved' => 'تایید شده',
                        'rejected' => 'رد شده',
                        default => $state,
                    }),

                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('وضعیت پرداخت')
                    ->colors([
                        'warning' => 'unpaid',
                        'info' => 'partial',
                        'success' => 'paid',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'unpaid' => 'پرداخت نشده',
                        'partial' => 'اقساطی',
                        'paid' => 'تسویه شده',
                        default => $state,
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('ویرایش'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('حذف'),
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
            'index' => \App\Filament\Resources\EnrollmentResource\Pages\ListEnrollments::route('/'),
            'create' => \App\Filament\Resources\EnrollmentResource\Pages\CreateEnrollment::route('/create'),
            'edit' => \App\Filament\Resources\EnrollmentResource\Pages\EditEnrollment::route('/{record}/edit'),
        ];
    }
}