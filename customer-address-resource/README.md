### Step 1: Create the Model and Migration

You already have the `CustomerAddress` model and migration. If you need to create them, you can run the following commands:

```bash
php artisan make:model CustomerAddress -m
```

Then, in the migration file, define the schema for the `customer_addresses` table:

```php
public function up()
{
    Schema::create('customer_addresses', function (Blueprint $table) {
        $table->id('id_customer_addresses');
        $table->unsignedBigInteger('id_customer');
        $table->string('alamat_lengkap', 120);
        $table->string('kota', 40);
        $table->string('provinsi', 20);
        $table->string('kode_pos', 20);
        $table->boolean('alamat_utama')->default(false);
        $table->string('patokan', 100)->nullable();
        $table->timestamps();

        $table->foreign('id_customer')->references('id_customer')->on('customers')->onDelete('cascade');
    });
}
```

### Step 2: Create the Resource

Run the following command to create a new resource for `CustomerAddress`:

```bash
php artisan make:filament-resource CustomerAddress
```

This will create a new resource in `app/Filament/Resources/CustomerAddressResource.php`.

### Step 3: Define the Resource Pages

In the `CustomerAddressResource.php`, define the form and table methods:

```php
namespace App\Filament\Resources;

use App\Models\CustomerAddress;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;

class CustomerAddressResource extends Resource
{
    protected static ?string $model = CustomerAddress::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Customer Management';
    protected static ?string $navigationLabel = 'Customer Addresses';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('alamat_lengkap')
                ->required(),
            Forms\Components\TextInput::make('kota')
                ->required(),
            Forms\Components\TextInput::make('provinsi')
                ->required(),
            Forms\Components\TextInput::make('kode_pos')
                ->required(),
            Forms\Components\Toggle::make('alamat_utama')
                ->label('Set as Main Address'),
            Forms\Components\TextInput::make('patokan')
                ->nullable(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('alamat_lengkap'),
                Tables\Columns\TextColumn::make('kota'),
                Tables\Columns\TextColumn::make('provinsi'),
                Tables\Columns\TextColumn::make('kode_pos'),
                Tables\Columns\BooleanColumn::make('alamat_utama')->label('Main Address'),
            ])
            ->filters([
                // Add any filters if needed
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRecords::class,
            'create' => CreateRecord::class,
            'edit' => EditRecord::class,
        ];
    }
}
```

### Step 4: Set Up Routes

Filament automatically handles the routing for resources, so you don't need to manually define routes for the resource. Just ensure that your Filament service provider is registered in `config/app.php`.

### Step 5: Create the Views

Filament will generate the necessary views for you. However, if you want to customize them, you can create Blade files in the `resources/views/filament` directory.

### Final Steps

1. **Run Migrations**: Make sure to run your migrations to create the `customer_addresses` table.

```bash
php artisan migrate
```

2. **Access the Resource**: You can access the customer addresses management interface through the Filament admin panel.

### Conclusion

You now have a fully functional resource for managing customer addresses with CRUD operations in your Laravel application using Filament. You can further customize the resource as needed.