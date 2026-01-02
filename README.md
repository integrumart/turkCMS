# turkCMS

Türk CMS, kurumsal düzeyde flat-file tabanlı bir içerik yönetim sistemidir.

## Özellikler

- **Flat-File Yapı**: Veritabanı gerektirmez, tüm içerik dosya sisteminde saklanır
- **Markdown Desteği**: İçerikler Markdown formatında yazılır ve YAML frontmatter destekler
- **PSR-4 Autoloading**: Modern PHP standartlarına uygun namespace yapısı
- **Tema Sistemi**: Esnek ve özelleştirilebilir tema yapısı
- **Regex Tabanlı Router**: Güçlü URL yönlendirme sistemi
- **Dot-Notation Config**: JSON tabanlı yapılandırma sistemi

## Gereksinimler

- PHP 7.4 veya üzeri
- Composer
- Apache/Nginx web sunucusu (mod_rewrite etkin)

## Kurulum

1. Repoyu klonlayın:
```bash
git clone https://github.com/integrumart/turkCMS.git
cd turkCMS
```

2. Composer bağımlılıklarını yükleyin:
```bash
composer install
```

3. Web sunucunuzu `public/` dizinine yönlendirin veya PHP yerleşik sunucusunu kullanın:
```bash
cd public
php -S localhost:8080
```

4. Tarayıcınızda açın: `http://localhost:8080`

## Dizin Yapısı

```
turkCMS/
├── app/                    # Uygulama mantığı
│   ├── Controllers/        # Controller sınıfları
│   └── Services/          # Servis sınıfları
├── core/                   # Çekirdek sistem
│   ├── Bootstrap.php      # Uygulama başlatıcı
│   ├── Config.php         # Yapılandırma yöneticisi
│   ├── Router.php         # URL yönlendirici
│   ├── Storage.php        # Dosya yardımcıları
│   └── View.php           # Görünüm motoru
├── content/               # İçerik dosyaları
│   └── pages/            # Sayfa içerikleri (.md)
├── data/                  # Veri dosyaları
│   └── config/           # Yapılandırma dosyaları (.json)
├── public/                # Web erişilebilir dizin
│   ├── .htaccess         # Apache rewrite kuralları
│   └── index.php         # Giriş noktası
├── themes/                # Tema dosyaları
│   └── default/          # Varsayılan tema
│       ├── layout.php    # Ana şablon
│       ├── home.php      # Ana sayfa görünümü
│       ├── page.php      # Sayfa görünümü
│       └── partials/     # Kısmi şablonlar
└── composer.json          # Bağımlılık tanımları
```

## Kullanım

### Yeni Sayfa Ekleme

1. `content/pages/` dizininde yeni bir `.md` dosyası oluşturun:

```markdown
---
title: Sayfa Başlığı
description: Sayfa açıklaması
author: Yazar Adı
date: 2026-01-02
---

# İçerik Başlığı

İçerik metni buraya gelir...
```

2. Sayfaya `/sayfa-adi` URL'sinden erişilebilir.

### Yapılandırma

Site yapılandırması `data/config/site.json` dosyasında tutulur:

```json
{
    "title": "Site Başlığı",
    "theme": "default",
    "lang": "tr",
    "description": "Site açıklaması"
}
```

### Tema Özelleştirme

Yeni bir tema oluşturmak için:

1. `themes/` dizininde yeni bir klasör oluşturun
2. Gerekli şablon dosyalarını ekleyin (`layout.php`, `home.php`, `page.php`)
3. `data/config/site.json` içindeki `theme` değerini değiştirin

## Rotalar

- `/` - Ana sayfa
- `/{slug}` - İçerik sayfaları
- `/admin` - Admin paneli
- `/admin/login` - Admin girişi

## Geliştirme

### Kod Standartları

- PSR-4 autoloading
- PSR-12 kod stili
- Strict typing (`declare(strict_types=1);`)
- Namespace: `turkCMS\`

### Test

```bash
# PHP yerleşik sunucu ile test
cd public
php -S localhost:8080

# Tarayıcıda test
curl http://localhost:8080/
curl http://localhost:8080/hakkimizda
```

## Lisans

Bu proje MIT lisansı altında lisanslanmıştır. Detaylar için `LICENSE` dosyasına bakın.

## Katkıda Bulunma

Katkılarınızı bekliyoruz! Pull request göndermekten çekinmeyin.

## İletişim

- GitHub: [integrumart/turkCMS](https://github.com/integrumart/turkCMS)

