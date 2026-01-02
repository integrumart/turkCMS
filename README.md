# turkCMS

Türk CMS, flat-file tabanlı kurumsal içerik yönetim sistemidir. Veritabanı gerektirmeden, dosya sisteminde Markdown ve JSON formatlarını kullanarak içerik ve yapılandırma yönetimi sağlar.

## Özellikler

- 🚀 **Flat-file Yapısı**: Veritabanı gerektirmez, tüm içerik ve yapılandırma dosyalarda saklanır
- 📝 **Markdown Desteği**: İçerikler Markdown formatında, YAML frontmatter ile metadata
- 🎨 **Tema Sistemi**: Esnek tema yapısı, kolay özelleştirme
- 🔧 **PSR-4 Autoloading**: Modern PHP standartları
- ⚡ **Hafif ve Hızlı**: Minimal bağımlılık, hızlı yükleme
- 🔒 **Strict Typing**: Tip güvenliği için PHP 7.4+ strict types

## Kurulum

### Gereksinimler

- PHP 7.4 veya üzeri
- Composer

### Adımlar

1. Depoyu klonlayın:
```bash
git clone https://github.com/integrumart/turkCMS.git
cd turkCMS
```

2. Bağımlılıkları yükleyin:
```bash
composer install
```

3. Web sunucusunu yapılandırın:
   - Apache için `public/.htaccess` dosyası hazır
   - Nginx için URL yeniden yazma kuralları eklemeniz gerekebilir

4. Yerel geliştirme için PHP'nin yerleşik sunucusunu kullanın:
```bash
cd public
php -S localhost:8000
```

Tarayıcınızda `http://localhost:8000` adresini ziyaret edin.

## Dizin Yapısı

```
turkCMS/
├── app/                    # Uygulama mantığı
│   ├── Controllers/        # HTTP isteklerini işleyen kontrolörler
│   └── Services/           # İş mantığı servisleri
├── core/                   # Çekirdek sistem bileşenleri
│   ├── Bootstrap.php       # Uygulama başlatıcı
│   ├── Config.php          # Yapılandırma yöneticisi
│   ├── Router.php          # URL yönlendirme
│   ├── Storage.php         # Dosya yolu yardımcısı
│   └── View.php            # Şablon motoru
├── content/                # İçerik dosyaları
│   └── pages/              # Sayfa içerikleri (Markdown)
├── data/                   # Yapılandırma ve veri dosyaları
│   └── config/             # JSON yapılandırma dosyaları
├── themes/                 # Tema dosyaları
│   └── default/            # Varsayılan tema
│       ├── layout.php      # Ana şablon
│       ├── home.php        # Anasayfa görünümü
│       ├── page.php        # Genel sayfa görünümü
│       └── partials/       # Parçalı şablonlar
├── public/                 # Web kök dizini
│   ├── .htaccess           # Apache URL yeniden yazma
│   └── index.php           # Giriş noktası
└── vendor/                 # Composer bağımlılıkları
```

## Kullanım

### Yeni Sayfa Ekleme

`content/pages/` dizininde yeni bir `.md` dosyası oluşturun:

```markdown
---
title: Sayfa Başlığı
description: Sayfa açıklaması
author: Yazar Adı
date: 2026-01-02
---

# Sayfa İçeriği

Markdown formatında içerik buraya gelir...
```

Sayfaya `/page/dosya-adi` URL'i ile erişilebilir.

### Yapılandırma

`data/config/site.json` dosyasını düzenleyerek site ayarlarını değiştirin:

```json
{
    "title": "Site Başlığı",
    "theme": "default",
    "lang": "tr"
}
```

### Tema Özelleştirme

`themes/default/` dizinindeki dosyaları düzenleyerek görünümü özelleştirin:

- `layout.php`: Ana HTML yapısı
- `home.php`: Anasayfa şablonu
- `page.php`: Genel sayfa şablonu
- `partials/header.php`: Başlık bölümü
- `partials/footer.php`: Alt bilgi bölümü

## Geliştirme

Kod PSR-12 standartlarına uygun olarak yazılmıştır ve strict typing kullanır.

### Namespace Yapısı

- `turkCMS\core\` - Çekirdek sistem sınıfları
- `turkCMS\app\Controllers\` - Kontrolörler
- `turkCMS\app\Services\` - Servis sınıfları

## Lisans

MIT License - Detaylar için `LICENSE` dosyasına bakın.
