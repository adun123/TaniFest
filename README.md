# Tani Feast

Tani Feast adalah aplikasi e-commerce berbasis Laravel untuk menjual bahan pangan segar, resep, dan paket kebutuhan dapur. Aplikasi ini memiliki dua area utama: customer untuk belanja dan checkout, serta admin untuk mengelola produk, resep, dan banner kategori.

## Ringkasan Fitur

### Customer
- Landing page publik dengan tampilan fresh-market ecommerce.
- Register dan login menggunakan nomor handphone atau email.
- Dashboard customer dengan banner, produk diskon, kategori, inspirasi resep, dan produk terbaik.
- Kategori produk dan daftar semua produk.
- Detail produk dengan galeri foto, varian, catatan, jumlah, dan add to cart.
- Daftar resep dan detail resep dengan bahan serta add to cart resep.
- Cart untuk produk dan resep, termasuk pilih item sebelum checkout.
- Checkout dengan alamat, jadwal pengiriman, metode pembayaran, bank, dan ringkasan pesanan.
- Riwayat pesanan dan halaman sukses pembayaran.
- Profile, alamat, keamanan, foto profile, dan ubah password.

### Admin
- Dashboard produk.
- CRUD produk dengan foto utama, foto tambahan, deskripsi, varian, kategori, stok, harga, dan diskon.
- CRUD resep dengan bahan, foto, video, harga, kategori, dan stok.
- CRUD banner kategori.
- Sidebar, header, dan layout admin yang sudah diredesign.

### API
- API auth register/login/logout.
- API profile.
- API product.
- API resep.
- API cart untuk produk dan resep.

## Teknologi

- PHP `^8.2`
- Laravel `^12.0`
- Laravel Breeze
- Laravel Sanctum
- Laravel Socialite
- MySQL
- Pest PHP untuk testing
- Vite
- Tailwind CSS
- Alpine.js
- Bootstrap CDN pada layout customer
- Font Awesome CDN pada layout customer

## Struktur Penting

```text
app/
  Http/Controllers/        Controller web dan API
  Http/Middleware/         Role middleware admin/customer
  Http/Requests/           Form request auth/profile
  Models/                  User, Product, Resep, Cart, Address, Transaction
  View/Components/         Class component Blade

database/
  migrations/              Struktur tabel aplikasi
  factories/               Factory testing

resources/
  css/app.css              Tailwind dan market design utilities
  js/app.js                Bootstrap aplikasi frontend
  views/admin/             Halaman admin
  views/customer/          Halaman customer
  views/profile/           Pengaturan profile customer
  views/auth/              Login/register/password pages
  views/components/        Blade components
  views/layouts/           Layout app, guest, navigation

routes/
  web.php                  Route web admin/customer/auth
  api.php                  Route API

tests/
  Feature/                 Feature tests
  Unit/                    Unit tests
```

## Persyaratan Lokal

Pastikan sudah tersedia:

- PHP 8.2 atau lebih baru
- Composer
- Node.js dan npm
- MySQL atau MariaDB
- Extension PHP yang umum untuk Laravel: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `tokenizer`, `xml`, `ctype`, `json`

Untuk XAMPP, project ini biasa dijalankan dari:

```text
C:\xampp\htdocs\TaniFeastRana\TaniFeastRana
```

## Instalasi

1. Clone repository.

```bash
git clone git@github.com:adun123/TaniFest.git
cd TaniFeastRana/TaniFeastRana
```

2. Install dependency PHP.

```bash
composer install
```

3. Install dependency frontend.

```bash
npm install
```

4. Buat file environment.

```bash
cp .env.example .env
```

Di Windows PowerShell jika `cp` tidak tersedia:

```powershell
Copy-Item .env.example .env
```

5. Generate app key.

```bash
php artisan key:generate
```

6. Atur database di `.env`.

Contoh konfigurasi lokal XAMPP:

```env
APP_NAME="Tani Feast"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tanifest
DB_USERNAME=root
DB_PASSWORD=
```

Catatan: beberapa database lokal lama mungkin bernama `tanifestrana`. Pastikan nama database di `.env` sama dengan database yang dibuat di MySQL.

7. Jalankan migration.

```bash
php artisan migrate
```

8. Buat symbolic link storage.

```bash
php artisan storage:link
```

9. Jalankan aplikasi.

```bash
php artisan serve
```

10. Jalankan Vite untuk development.

```bash
npm run dev
```

Buka aplikasi di:

```text
http://127.0.0.1:8000
```

## Perintah Development

Menjalankan server Laravel:

```bash
php artisan serve
```

Menjalankan Vite development server:

```bash
npm run dev
```

Build asset production:

```bash
npm run build
```

Clear cache Laravel:

```bash
php artisan optimize:clear
```

Compile Blade view cache:

```bash
php artisan view:cache
```

Refresh autoload Composer:

```bash
composer dump-autoload
```

## Testing

Jalankan semua test:

```bash
php artisan test
```

Atau melalui Composer script:

```bash
composer test
```

Menjalankan test tertentu:

```bash
php artisan test --filter=CustomerDashboardTest
php artisan test --filter=AuthenticationTest
php artisan test --filter=ProfileTest
```

Validasi yang direkomendasikan sebelum push:

```bash
php artisan view:cache
php artisan test
npm run build
```

Di Windows PowerShell, jika `npm` terkena policy execution, gunakan:

```powershell
npm.cmd run build
```

## Role User

Aplikasi memakai role user:

- `admin`: akses dashboard admin, produk, resep, dan category banner.
- `customer`: akses dashboard customer, cart, checkout, profile, dan riwayat pesanan.

Route utama akan mengarahkan `/dashboard` berdasarkan role user:

- Admin ke `admin.dashboard`
- Customer ke `customer.dashboard`

## Route Utama

### Public dan Auth

| Method | URL | Nama Route | Keterangan |
|---|---|---|---|
| GET | `/` | - | Landing page |
| GET/POST | `/login` | `login` | Login |
| GET/POST | `/register` | `register` | Register |
| POST | `/logout` | `logout` | Logout |
| GET | `/auth/google` | `google.login` | Google OAuth redirect |

### Customer

| Method | URL | Nama Route | Keterangan |
|---|---|---|---|
| GET | `/customer/dashboard` | `customer.dashboard` | Dashboard customer |
| GET | `/kategori` | `customer.category.semua` | Semua kategori |
| GET | `/productlist` | `customer.category` | Product list dengan filter kategori |
| GET | `/product/{product}` | `product.detail` | Detail produk |
| GET | `/customer/product/{product}` | `customer.product.show` | Detail produk customer |
| GET | `/resep-customer` | `customer.reseps.index` | Daftar resep |
| GET | `/resep-customer/{id}` | `customer.reseps.show` | Detail resep |
| GET | `/cart` | `cart.index` | Cart |
| POST | `/cart/add/{product}` | `cart.store` | Tambah produk ke cart |
| POST | `/cart/cart-resep/{resep}` | `cart.resep.store` | Tambah resep ke cart |
| PATCH | `/cart/update/{cartItem}` | `cart.update` | Update quantity cart |
| DELETE | `/cart/remove/{cartItem}` | `cart.destroy` | Hapus item cart |
| POST | `/checkout` | `checkout.store` | Mulai checkout dari cart terpilih |
| POST | `/checkout/pay` | `checkout.pay` | Proses pembayaran |
| GET | `/checkout/success/{id}` | `checkout.success` | Halaman sukses |
| GET | `/transactions/history` | `transactions.history` | Riwayat pesanan |
| GET | `/search` | `customer.search` | Search produk dan resep |
| GET/PATCH/DELETE | `/profile` | `profile.*` | Profile user |
| POST | `/profile/alamat` | `profile.address.store` | Tambah alamat |
| PUT/DELETE | `/profile/address/{id}` | `profile.address.*` | Update/hapus alamat |

### Admin

| Method | URL | Nama Route | Keterangan |
|---|---|---|---|
| GET | `/admin/dashboard` | `admin.dashboard` | Dashboard produk admin |
| POST | `/products` | `products.store` | Tambah produk |
| PUT | `/products/{product}` | `products.update` | Update produk |
| DELETE | `/products/{product}` | `products.destroy` | Hapus produk |
| GET | `/products/{product}/edit` | `products.edit` | Data produk JSON untuk edit |
| GET | `/reseps` | `admin.reseps.index` | Admin resep |
| POST | `/reseps` | `admin.reseps.store` | Tambah resep |
| PUT | `/reseps/{resep}` | `admin.reseps.update` | Update resep |
| DELETE | `/reseps/{resep}` | `admin.reseps.destroy` | Hapus resep |
| GET | `/category-banners` | `category-banners.index` | Admin category banner |
| POST | `/category-banners` | `category-banners.store` | Tambah category banner |
| PUT | `/category-banners/{categoryBanner}` | `category-banners.update` | Update banner |
| DELETE | `/category-banners/{categoryBanner}` | `category-banners.destroy` | Hapus banner |

## Data dan Model Utama

### User

Menyimpan akun admin/customer. Field penting:

- `name`
- `first_name`
- `last_name`
- `email` nullable
- `phone`
- `role`
- `photo`
- `google_id`
- `address`

Relasi:

- `User hasMany Address`

### Product

Menyimpan produk bahan pangan. Field penting:

- `nama`
- `jumlah`
- `harga`
- `discount_percentage`
- `category`
- `photo`
- `description`
- `variants` sebagai array JSON
- `photos` sebagai array JSON

Helper model:

- `variantLabel()` untuk menampilkan varian sebagai teks.
- `variantOptions()` untuk pilihan varian di detail produk.
- `photoGallery()` untuk galeri foto tambahan.

### Resep

Menyimpan resep/paket bahan. Field umum:

- `nama`
- `deskripsi`
- `foto`
- `video`
- `kategori`
- `harga`
- `stok`

Relasi:

- `Resep hasMany Bahan`

### Cart

Mendukung item product dan resep:

- `user_id`
- `product_id` nullable
- `resep_id` nullable
- `quantity`

### Address

Alamat pengiriman customer:

- `user_id`
- `recipient_name`
- `phone`
- `full_address`
- `postal_code`

### Transaction dan TransactionItem

Menyimpan checkout, metode pembayaran, status, dan item pesanan:

- `user_id`
- `address_id`
- `delivery_day`
- `delivery_time`
- `shipping_method`
- `payment_method`
- `bank_option`
- `shipping_cost`
- `total_price`
- `virtual_account`
- `status`

## Catatan Database

Migration sudah mencakup tabel utama:

- `users`
- `products`
- `reseps`
- `bahans`
- `category_banners`
- `carts`
- `addresses`
- `transactions`
- `transaction_items`
- `personal_access_tokens`

Jika muncul error table tidak ditemukan, cek status migration:

```bash
php artisan migrate:status
```

Lalu jalankan:

```bash
php artisan migrate
```

## File Upload dan Storage

Produk, resep, banner, dan foto profile memakai storage Laravel. Pastikan symbolic link sudah dibuat:

```bash
php artisan storage:link
```

File upload biasanya disimpan di disk `public`, lalu diakses dengan:

```php
asset('storage/' . $path)
```

## Desain UI

UI aplikasi memakai tema fresh-market ecommerce:

- Warna utama leaf green, cream, sage, clay, dan gold.
- Utility utama berada di `resources/css/app.css`:
  - `.market-shell`
  - `.market-container`
  - `.market-card`
  - `.market-card-soft`
  - `.market-button`
  - `.market-button-outline`
  - `.market-input`
  - `.market-chip`
  - `.market-product-card`

Halaman yang sudah diredesign:

- Landing page `/`
- Auth pages
- Customer dashboard
- Category/product list
- Product detail
- Recipe pages
- Cart
- Checkout
- Order history
- Success page
- Profile/settings/address/privacy
- Admin dashboard/products
- Admin recipe page
- Admin category banner page

## Kontrak Frontend yang Perlu Dijaga

Saat mengubah UI, jangan hapus hook berikut karena dipakai JavaScript/form flow:

### Cart

- `.cart-checkbox`
- `#selected-items`
- `#total-price`
- `#cart-ids-container`
- `#checkout-btn`
- `quantity-input-{id}`
- `quantity-form-{id}`
- `delete-form-{id}`

### Checkout

- `#delivery_day_selector`
- `#date_picker_container`
- `#date_picker`
- `#delivery_time`
- `.payment-method-btn`
- `.bank-radio`
- `#transfer-bank-section`
- `#other-method-section`
- `#form_payment_method`
- `#form_bank_option`
- `cart_ids[]`
- `address_id`
- `delivery_day`
- `delivery_time`
- `payment_method`
- `bank_option`

### Product Detail

- `#selectedVariant`
- `#quantityInput`
- `#decreaseQty`
- `#increaseQty`
- `selectVariant()`

### Profile

- `#profileTab`
- `#alamatTab`
- `#privacyTab`
- `#btnProfile`
- `#btnAlamat`
- `#btnPrivacy`
- `showTab()`
- `#editProfileModal`
- `#passwordModal`
- `#modal`
- `#edit-modal`

## Google Login

Project memakai Laravel Socialite. Route Google login tersedia:

```text
/auth/google
/auth/google/callback
```

Tambahkan konfigurasi berikut di `.env` jika ingin mengaktifkan OAuth Google:

```env
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

Pastikan konfigurasi service Google juga tersedia di `config/services.php` jika belum ada.

## Build Production

Untuk production build:

```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```

Pastikan `.env` production menggunakan:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-produksi.com
```

## Troubleshooting

### `SQLSTATE[42S02]: Base table or view not found`

Artinya tabel belum ada di database aktif. Jalankan:

```bash
php artisan migrate:status
php artisan migrate
```

Pastikan `DB_DATABASE` di `.env` benar.

### `Column 'email' cannot be null`

Flow register aplikasi memakai nomor handphone dan email nullable. Pastikan migration email nullable sudah berjalan:

```bash
php artisan migrate:status
```

### Gambar tidak muncul

Jalankan:

```bash
php artisan storage:link
```

Pastikan file benar-benar ada di `storage/app/public`.

### Blade menampilkan `{{ $slot }}` literal

Clear cache Laravel:

```bash
php artisan optimize:clear
php artisan view:cache
```

Pastikan class component `app/View/Components/AdminLayout.php` hanya merender view `components.admin-layout`.

### `npm` tidak bisa dijalankan di PowerShell

Gunakan:

```powershell
npm.cmd run dev
npm.cmd run build
```

### Build warning Browserslist

Jika muncul warning `caniuse-lite is outdated`, build tetap bisa berhasil. Untuk update data browser:

```bash
npx update-browserslist-db@latest
```

## Workflow Git yang Disarankan

Sebelum commit:

```bash
php artisan view:cache
php artisan test
npm run build
git status
```

Commit per concern:

```bash
git add <files>
git commit -m "pesan commit"
```

Push:

```bash
git push origin main
```

Jika remote memakai SSH, pastikan SSH key GitHub sudah terpasang.

## Status Validasi Terakhir

Validasi yang terakhir dijalankan selama pengembangan:

- `php artisan view:cache` passed
- `php artisan test` passed dengan 27 tests dan 66 assertions
- `npm.cmd run build` passed
- Browser smoke check landing page, login, register, dashboard, kategori, dan profile tanpa console error

## Lisensi

Project ini dibangun di atas Laravel yang berlisensi MIT. Lisensi final aplikasi mengikuti kebijakan pemilik repository.
