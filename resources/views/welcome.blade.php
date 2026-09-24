<!DOCTYPE html>
<html class="scroll-smooth" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>PinjamBarang - Sistem Peminjaman Barang &amp; Inventaris Modern</title>
<!-- Inter Font Family -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;family=Space+Grotesk:wght@500;700&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS v3 with Plugins -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Tailwind Configuration -->
<script data-purpose="tailwind-config">
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            display: ['"Space Grotesk"', 'sans-serif'],
          },
          colors: {
            brand: {
              pitch: '#050508',
              surface: '#0B0B14',
              elevated: '#121124',
              purple: '#7C3AED',
              deepPurple: '#5B21B6',
              glow: '#8B5CF6',
              accent: '#A78BFA',
            }
          },
          boxShadow: {
            'glow-sm': '0 0 20px -3px rgba(124, 58, 237, 0.4)',
            'glow-md': '0 0 35px -5px rgba(139, 92, 246, 0.45)',
            'glow-lg': '0 0 65px -10px rgba(139, 92, 246, 0.55)',
            'card-dark': '0 20px 40px -15px rgba(0,0,0,0.7)',
          }
        }
      }
    }
  </script>
<!-- Keyframe Animations & Glow Styles -->
<style data-purpose="animations">
    @keyframes pulseGlow {
      0%, 100% {
        opacity: 0.85;
        transform: scale(1) translateY(0px);
        filter: drop-shadow(0 0 45px rgba(139, 92, 246, 0.65));
      }
      50% {
        opacity: 1;
        transform: scale(1.025) translateY(-4px);
        filter: drop-shadow(0 0 75px rgba(167, 139, 250, 0.95));
      }
    }

    @keyframes subtleFloat {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-6px); }
    }

    .animated-arc {
      animation: pulseGlow 7s ease-in-out infinite;
    }

    .float-slow {
      animation: subtleFloat 5s ease-in-out infinite;
    }

    .arc-mask {
      mask-image: radial-gradient(circle at 50% 30%, black 40%, transparent 75%);
      -webkit-mask-image: radial-gradient(circle at 50% 30%, black 40%, transparent 75%);
    }

    @keyframes ringPulse {
        0%, 100% { transform: scale(1); filter: drop-shadow(0 0 40px rgba(124, 58, 237, 0.5)); }
        50% { transform: scale(1.02); filter: drop-shadow(0 0 80px rgba(167, 139, 250, 1)); }
    }
    .animated-ring {
        animation: ringPulse 4s ease-in-out infinite;
    }

    @keyframes pulseOpacity {
        0%, 100% { opacity: 0.7; }
        50% { opacity: 1; }
    }
    .animated-pulse {
        animation: pulseOpacity 4s ease-in-out infinite;
    }

    @keyframes pageFadeIn {
        from {
            opacity: 0;
            filter: blur(10px);
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            filter: blur(0);
            transform: translateY(0);
        }
    }

    .page-transition-blur {
        animation: pageFadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
  </style>
<!-- Glassmorphism & Custom Component Styles -->
<style data-purpose="components">
    .glass-card {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .glass-card-hover {
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .glass-card-hover:hover {
      transform: translateY(-4px);
      border-color: rgba(167, 139, 250, 0.35);
      box-shadow: 0 14px 30px -10px rgba(124, 58, 237, 0.25);
    }

    .purple-radial-gradient {
      background: radial-gradient(circle at center, rgba(124, 58, 237, 0.18) 0%, rgba(5, 5, 8, 0) 70%);
    }

    html {
      scroll-behavior: smooth;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #050508;
    }
    ::-webkit-scrollbar-thumb {
      background: #1f1d36;
      border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #3b2d69;
    }
  </style>
</head>
<body class="bg-[#050508] text-slate-100 font-sans antialiased selection:bg-purple-600 selection:text-white overflow-x-hidden page-transition-blur">
<!-- BEGIN: MainHeader -->
<header class="sticky top-0 z-50 w-full transition-all duration-300">
<!-- Navbar Container with Frosted Glass -->
<nav class="backdrop-blur-md bg-[#0b0b14]/80 border-b border-white/[0.07] px-6 lg:px-12 py-3.5 transition-all duration-200">
<div class="max-w-7xl mx-auto flex items-center justify-between">
<!-- Brand Logo -->
<a href="#" class="flex items-center gap-3 group">
    <div class="w-10 h-10 rounded-xl overflow-hidden shadow-[0_0_20px_rgba(167,139,250,0.5)] border border-purple-500/40 transition-transform group-hover:scale-105">
        <img src="{{ asset('images/logopeminjamanbarang.png') }}" alt="PinjamBarang Logo" class="w-full h-full object-cover">
    </div>
    <span class="text-white font-extrabold text-lg tracking-tight font-display">
        Pinjam<span class="text-purple-400">Barang.</span>
    </span>
</a>
<!-- Navigation Links -->
<div class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-300">
<a class="text-white hover:text-purple-400 transition-colors duration-200" href="#beranda">Beranda</a>
<a class="hover:text-purple-400 transition-colors duration-200" href="#fitur">Fitur</a>
<a class="hover:text-purple-400 transition-colors duration-200" href="#katalog">Katalog Aset</a>
<a class="hover:text-purple-400 transition-colors duration-200" href="#alur-kerja">Alur Kerja</a>
<a class="hover:text-purple-400 transition-colors duration-200" href="#bantuan">Bantuan</a>
</div>
<!-- Action CTA Buttons -->
<div class="flex items-center gap-3">
<a class="hidden sm:inline-flex items-center px-4 py-2 text-xs font-semibold rounded-full border border-white/15 text-slate-200 hover:text-white hover:border-purple-400/50 hover:bg-white/5 transition duration-200" href="#demo">
            Demo Sistem
          </a>
<a class="inline-flex items-center gap-1.5 px-5 py-2 text-xs font-semibold rounded-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white shadow-glow-sm hover:shadow-glow-md hover:brightness-110 active:scale-95 transition-all duration-200" href="{{ route('login') }}">
<span>Login Admin</span>
<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24">
<line x1="5" x2="19" y1="12" y2="12"></line>
<polyline points="12 5 19 12 12 19"></polyline>
</svg>
</a>
</div>
</div>
</nav>
</header>
<!-- END: MainHeader -->
<!-- BEGIN: HeroSection -->
<!-- ANIMASI CAHAYA & CINCIN -->
<style>
    @keyframes ringPulse {
        0%, 100% { transform: scale(1); filter: drop-shadow(0 0 20px rgba(124, 58, 237, 0.4)); }
        50% { transform: scale(1.01); filter: drop-shadow(0 0 50px rgba(167, 139, 250, 0.8)); }
    }
    @keyframes floatGlow {
        0%, 100% { opacity: 0.5; transform: translateY(0); }
        50% { opacity: 0.8; transform: translateY(-20px); }
    }
    .animated-ring { animation: ringPulse 6s ease-in-out infinite; }
    .animated-bottom-glow { animation: floatGlow 5s ease-in-out infinite alternate; }
</style>

<!-- HERO SECTION MULAI -->
<section class="relative pt-24 pb-20 overflow-hidden flex flex-col items-center justify-center min-h-screen" id="beranda" data-purpose="hero-container">
    
    <!-- ========================================== -->
    <!-- FIX: CAHAYA DI BAGIAN BAWAH (Biar Gak Hitam) -->
    <!-- ========================================== -->
    <div class="absolute bottom-0 left-0 w-full h-[50vh] bg-gradient-to-t from-purple-900/70 via-indigo-900/10 to-transparent pointer-events-none -z-20"></div>
    <div class="absolute bottom-[-150px] left-[20%] w-[500px] h-[300px] bg-blue-600/40 blur-[120px] rounded-full pointer-events-none -z-10 animated-bottom-glow"></div>
    <div class="absolute bottom-[-150px] right-[20%] w-[500px] h-[300px] bg-fuchsia-600/40 blur-[120px] rounded-full pointer-events-none -z-10 animated-bottom-glow" style="animation-delay: 2s;"></div>

    <!-- ========================================== -->
    <!-- FIX: CINCIN 4 LAPIS (Multi-Gradient) -->
    <!-- ========================================== -->
    <div class="absolute top-0 left-0 w-full h-[850px] overflow-hidden -z-10 flex justify-center pointer-events-none">
        
        <!-- CAHAYA INTI DI TENGAH -->
        <div class="absolute top-[120px] w-[90vw] max-w-[1200px] h-[600px] bg-[radial-gradient(ellipse_at_center,_rgba(167,139,250,0.85)_0%,_rgba(124,58,237,0.5)_50%,_transparent_75%)] blur-[80px]"></div>

        <!-- LAPISAN 1: Ungu Gelap (Paling Luar & Tebal) -->
        <div class="absolute top-[80px] w-[160vw] min-w-[1200px] max-w-[2400px] aspect-square rounded-full border-[40px] border-purple-900/40 blur-[30px] animated-ring"></div>
        
        <!-- LAPISAN 2: Ungu Terang -->
        <div class="absolute top-[80px] w-[160vw] min-w-[1200px] max-w-[2400px] aspect-square rounded-full border-[20px] border-purple-600/70 blur-[15px] animated-ring"></div>
        
        <!-- LAPISAN 3: Pink / Fuchsia -->
        <div class="absolute top-[80px] w-[160vw] min-w-[1200px] max-w-[2400px] aspect-square rounded-full border-[8px] border-fuchsia-400/90 blur-[5px] animated-ring"></div>
        
        <!-- LAPISAN 4: Putih Neon (Teras Paling Tajam) -->
        <div class="absolute top-[80px] w-[160vw] min-w-[1200px] max-w-[2400px] aspect-square rounded-full border-[3px] border-white shadow-[0_0_80px_20px_rgba(167,139,250,0.8),inset_0_0_80px_20px_rgba(167,139,250,0.8)] animated-ring"></div>
        
    </div>

    <!-- 3. KONTEN HERO -->
    <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-purple-300/30 bg-purple-950/40 backdrop-blur-md mb-8 shadow-glow-sm">
            <span class="text-[11px] font-bold text-white tracking-wide uppercase">Sistem Peminjaman Otomatis &amp; Terintegrasi Admin</span>
        </div>

        <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold tracking-tight font-display leading-[1.08] mb-6 text-white drop-shadow-2xl">
            Pinjam Peralatan &amp; Aset<br/>
            Lebih <span class="text-white drop-shadow-[0_0_15px_rgba(255,255,255,0.8)]">Cepat dan Transparan</span>
        </h1>

        <p class="max-w-2xl mx-auto text-base md:text-lg text-purple-50 font-medium leading-relaxed mb-10 drop-shadow-md">
            Cukup isi identitas nama, nickname, kontak, dan tanggal peminjaman. Permohonan langsung diteruskan ke admin secara real-time dengan status yang dapat Anda pantau mandiri.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
            <a href="#ajukan" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full font-bold text-sm text-purple-950 bg-white shadow-[0_0_30px_rgba(255,255,255,0.6)] hover:shadow-[0_0_50px_rgba(255,255,255,0.9)] hover:scale-105 active:scale-95 transition-all duration-300">
                Ajukan Peminjaman Barang
            </a>
            <a href="{{ route('lacak.status') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full font-bold text-sm text-white border border-white/20 bg-white/[0.05] backdrop-blur-md hover:bg-white/[0.1] hover:border-white/50 transition duration-200">
                Lacak Status Pengajuan
            </a>
        </div>

        <!-- TRACKING FORM -->
        <div class="max-w-md mx-auto mb-16" id="lacak">
            <form action="{{ route('lacak.status') }}" method="GET" class="relative flex items-center shadow-[0_0_30px_rgba(167,139,250,0.15)] rounded-full">
                <input type="text" name="keyword" placeholder="Masukkan Kode PJ- / No. WhatsApp..." class="w-full px-6 py-4 pr-16 rounded-full bg-black/40 text-white text-sm border border-white/20 focus:border-purple-400 focus:ring-1 focus:ring-purple-400 outline-none backdrop-blur-xl transition-all placeholder:text-slate-500" required>
                <button type="submit" class="absolute right-2 p-3 rounded-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white transition-all hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        <!-- DASHBOARD STYLE METRICS -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto border-t border-white/20 pt-10 relative">
            <div class="bg-black/30 backdrop-blur-xl rounded-2xl p-6 text-center border border-white/10 hover:border-purple-400/50 transition-colors shadow-lg">
                <h4 class="text-3xl font-extrabold text-white mb-1">{{ $totalAset }}</h4>
                <p class="text-xs text-purple-200">Total Aset Barang</p>
            </div>
            <div class="bg-black/30 backdrop-blur-xl rounded-2xl p-6 text-center border border-white/10 hover:border-emerald-400/50 transition-colors shadow-lg">
                <h4 class="text-3xl font-extrabold text-emerald-300 mb-1">{{ $barangSiap }}</h4>
                <p class="text-xs text-purple-200">Barang Siap Dipinjam</p>
            </div>
            <div class="bg-black/30 backdrop-blur-xl rounded-2xl p-6 text-center border border-white/10 hover:border-indigo-400/50 transition-colors shadow-lg">
                <h4 class="text-3xl font-extrabold text-indigo-300 mb-1">{{ $totalPeminjaman }}</h4>
                <p class="text-xs text-purple-200">Total Peminjaman</p>
            </div>
            <div class="bg-black/30 backdrop-blur-xl rounded-2xl p-6 text-center border border-white/10 hover:border-fuchsia-400/50 transition-colors shadow-lg">
                <h4 class="text-3xl font-extrabold text-fuchsia-300 mb-1">{{ $sedangDiproses }}</h4>
                <p class="text-xs text-purple-200">Sedang Diproses/Aktif</p>
            </div>
        </div>
    </div>
</section>
<!-- END: HeroSection -->
<!-- BEGIN: FeatureGridSection -->
<section class="relative py-20 px-6 lg:px-12 bg-[#050508]" data-purpose="features" id="fitur">
    
<!-- EFEK TRANSISI BLUR & FADE OUT ANTAR SECTION -->
<div class="absolute top-0 left-0 w-full h-48 bg-gradient-to-b from-purple-900/20 via-purple-900/5 to-[#050508] pointer-events-none"></div>

<div class="max-w-3xl mx-auto text-center mb-16 relative z-10">
<h2 class="text-3xl md:text-4xl font-extrabold font-display tracking-tight text-white mb-4">
        Inovasi Peminjaman. <span class="text-purple-400">Solusi Lengkap.</span>
</h2>
<p class="text-slate-400 text-sm md:text-base leading-relaxed">
        Kelola siklus hidup inventaris dan aset dengan sistem cerdas tanpa birokrasi berbelit. Dirancang untuk transparansi dan ketepatan.
      </p>
</div>
<div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10">
<div class="glass-card glass-card-hover rounded-2xl p-7 flex flex-col justify-between h-[230px] relative overflow-hidden group">
<div>
<div class="flex items-center justify-between mb-4">
<div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
</div>
<span class="text-slate-500 group-hover:text-purple-300 transition-colors duration-200">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><line x1="7" x2="17" y1="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
</span>
</div>
<h3 class="text-lg font-bold text-white mb-2 group-hover:text-purple-200 transition-colors">Katalog Aset Digital</h3>
<p class="text-slate-400 text-xs leading-relaxed">
            Daftar lengkap inventaris dengan spesifikasi teknis, kondisi fisik, foto aktual, dan status ketersediaan secara real-time.
          </p>
</div>
<div class="flex items-center text-[11px] font-semibold text-purple-400 tracking-wide uppercase">
          Eksplorasi Barang →
        </div>
</div>
<!-- Vibrant Solid Purple Highlight -->
<div class="rounded-2xl p-7 flex flex-col justify-between h-[230px] relative bg-gradient-to-br from-[#5B21B6] via-[#6D28D9] to-[#4C1D95] shadow-glow-md hover:shadow-glow-lg hover:-translate-y-1 transition duration-300 text-white group">
<div>
<div class="flex items-center justify-between mb-4">
<div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white border border-white/20">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewbox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
</div>
<span class="text-purple-200 group-hover:text-white transition-colors duration-200">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><line x1="7" x2="17" y1="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
</span>
</div>
<h3 class="text-lg font-bold text-white mb-2">Verifikasi Instan Admin</h3>
<p class="text-purple-100/90 text-xs leading-relaxed">
            Otomasi persetujuan berjenjang dengan one-click approval via dashboard admin atau tautan cepat aman tanpa login berulang.
          </p>
</div>
<div class="flex items-center text-[11px] font-bold text-white/95 tracking-wide uppercase">
          Lihat Alur Persetujuan →
        </div>
</div>
<div class="glass-card glass-card-hover rounded-2xl p-7 flex flex-col justify-between h-[230px] relative overflow-hidden group">
<div>
<div class="flex items-center justify-between mb-4">
<div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><rect height="18" rx="2" width="18" x="3" y="3"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
</div>
<span class="text-slate-500 group-hover:text-purple-300 transition-colors duration-200">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><line x1="7" x2="17" y1="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
</span>
</div>
<h3 class="text-lg font-bold text-white mb-2 group-hover:text-purple-200 transition-colors">Lacak Status &amp; Barcode</h3>
<p class="text-slate-400 text-xs leading-relaxed">
            Pengecekan posisi dan pengguna barang lewat Barcode &amp; QR Code scan untuk proses serah terima transparan.
          </p>
</div>
<div class="flex items-center text-[11px] font-semibold text-purple-400 tracking-wide uppercase">
          Sistem QR Pintar →
        </div>
</div>
<div class="glass-card glass-card-hover rounded-2xl p-7 flex flex-col justify-between h-[230px] relative overflow-hidden group">
<div>
<div class="flex items-center justify-between mb-4">
<div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
</div>
<span class="text-slate-500 group-hover:text-purple-300 transition-colors duration-200">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><line x1="7" x2="17" y1="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
</span>
</div>
<h3 class="text-lg font-bold text-white mb-2 group-hover:text-purple-200 transition-colors">Notifikasi WhatsApp Otomatis</h3>
<p class="text-slate-400 text-xs leading-relaxed">
            Pengingat tenggat waktu pengembalian otomatis via WhatsApp dan Email agar aset kembali aman dan bebas denda.
          </p>
</div>
<div class="flex items-center text-[11px] font-semibold text-purple-400 tracking-wide uppercase">
          Integrasi Notifikasi →
        </div>
</div>
<div class="glass-card glass-card-hover rounded-2xl p-7 flex flex-col justify-between h-[230px] relative overflow-hidden group">
<div>
<div class="flex items-center justify-between mb-4">
<div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
</div>
<span class="text-slate-500 group-hover:text-purple-300 transition-colors duration-200">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><line x1="7" x2="17" y1="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
</span>
</div>
<h3 class="text-lg font-bold text-white mb-2 group-hover:text-purple-200 transition-colors">Riwayat &amp; Tanda Tangan</h3>
<p class="text-slate-400 text-xs leading-relaxed">
            Catatan log peminjaman digital permanen lengkap dengan bukti serah terima foto dan tanda tangan elektronik.
          </p>
</div>
<div class="flex items-center text-[11px] font-semibold text-purple-400 tracking-wide uppercase">
          Pelajari Audit Log →
        </div>
</div>
<div class="glass-card glass-card-hover rounded-2xl p-7 flex flex-col justify-between h-[230px] relative overflow-hidden group">
<div>
<div class="flex items-center justify-between mb-4">
<div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><rect height="11" rx="2" ry="2" width="18" x="3" y="11"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
</div>
<span class="text-slate-500 group-hover:text-purple-300 transition-colors duration-200">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><line x1="7" x2="17" y1="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
</span>
</div>
<h3 class="text-lg font-bold text-white mb-2 group-hover:text-purple-200 transition-colors">Keamanan Multi-Role</h3>
<p class="text-slate-400 text-xs leading-relaxed">
            Hak akses berjenjang untuk Peminjam, Staff Gudang, Kepala Laboratorium, dan Super Admin dengan enkripsi enterprise.
          </p>
</div>
<div class="flex items-center text-[11px] font-semibold text-purple-400 tracking-wide uppercase">
          Sistem Keamanan →
        </div>
</div>
</div>
</section>
<!-- END: FeatureGridSection -->
<!-- BEGIN: FullWidthProcessBanner -->
<section class="relative py-24 px-6 lg:px-12 bg-gradient-to-b from-[#180B33] via-[#2A0E5C] to-[#14082B] border-y border-purple-500/20 overflow-hidden" data-purpose="process-flow" id="alur-kerja">
<div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_var(--tw-gradient-stops))] from-purple-500/15 via-transparent to-transparent pointer-events-none"></div>
<div class="max-w-6xl mx-auto relative z-10">
<div class="text-center max-w-2xl mx-auto mb-16">
<h2 class="text-3xl md:text-4xl font-extrabold font-display tracking-tight text-white mb-4">
          Built on Trust. Alur Peminjaman 4 Langkah.
        </h2>
<p class="text-purple-200/80 text-sm md:text-base leading-relaxed">
          Kemudahan proses peminjaman yang transparan dan akuntabel bagi seluruh staf, guru, mahasiswa, dan siswa.
        </p>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
<div class="bg-purple-950/30 backdrop-blur-md rounded-2xl p-6 border border-purple-400/20 hover:border-purple-300/50 hover:bg-purple-900/30 transition-all duration-300 flex flex-col justify-between h-[210px] group">
<div class="flex items-center justify-between">
<span class="text-3xl font-extrabold font-display text-purple-200/90 group-hover:text-white transition-colors">01</span>
<div class="w-8 h-8 rounded-full border border-purple-400/30 flex items-center justify-center text-purple-300 group-hover:border-purple-200">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><line x1="7" x2="17" y1="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
</div>
</div>
<div>
<h3 class="text-base font-bold text-white mb-1.5">Pilih Barang</h3>
<p class="text-purple-200/70 text-xs leading-relaxed">
              Cari &amp; pilih ratusan inventaris siap pakai dengan detail spesifikasi dan panduan pemakaian.
            </p>
</div>
</div>
<div class="bg-purple-950/30 backdrop-blur-md rounded-2xl p-6 border border-purple-400/20 hover:border-purple-300/50 hover:bg-purple-900/30 transition-all duration-300 flex flex-col justify-between h-[210px] group">
<div class="flex items-center justify-between">
<span class="text-3xl font-extrabold font-display text-purple-200/90 group-hover:text-white transition-colors">02</span>
<div class="w-8 h-8 rounded-full border border-purple-400/30 flex items-center justify-center text-purple-300 group-hover:border-purple-200">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><line x1="7" x2="17" y1="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
</div>
</div>
<div>
<h3 class="text-base font-bold text-white mb-1.5">Isi Formulir</h3>
<p class="text-purple-200/70 text-xs leading-relaxed">
              Tentukan durasi, keperluan, dan unggah syarat peminjaman dalam kurang dari 1 menit.
            </p>
</div>
</div>
<div class="bg-purple-950/30 backdrop-blur-md rounded-2xl p-6 border border-purple-400/20 hover:border-purple-300/50 hover:bg-purple-900/30 transition-all duration-300 flex flex-col justify-between h-[210px] group">
<div class="flex items-center justify-between">
<span class="text-3xl font-extrabold font-display text-purple-200/90 group-hover:text-white transition-colors">03</span>
<div class="w-8 h-8 rounded-full border border-purple-400/30 flex items-center justify-center text-purple-300 group-hover:border-purple-200">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><line x1="7" x2="17" y1="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
</div>
</div>
<div>
<h3 class="text-base font-bold text-white mb-1.5">Persetujuan Admin</h3>
<p class="text-purple-200/70 text-xs leading-relaxed">
              Verifikasi instan via dashboard admin dan integrasi notifikasi cepat secara otomatis.
            </p>
</div>
</div>
<div class="bg-purple-950/30 backdrop-blur-md rounded-2xl p-6 border border-purple-400/20 hover:border-purple-300/50 hover:bg-purple-900/30 transition-all duration-300 flex flex-col justify-between h-[210px] group">
<div class="flex items-center justify-between">
<span class="text-3xl font-extrabold font-display text-purple-200/90 group-hover:text-white transition-colors">04</span>
<div class="w-8 h-8 rounded-full border border-purple-400/30 flex items-center justify-center text-purple-300 group-hover:border-purple-200">
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><line x1="7" x2="17" y1="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
</div>
</div>
<div>
<h3 class="text-base font-bold text-white mb-1.5">Ambil Barang &amp; Scan</h3>
<p class="text-purple-200/70 text-xs leading-relaxed">
              Cukup scan QR code pada saat serah terima barang fisik di gudang inventaris.
            </p>
</div>
</div>
</div>
</div>
</section>
<!-- END: FullWidthProcessBanner -->
<!-- BEGIN: SolutionsAndCatalogSection -->
<section class="relative py-24 px-6 lg:px-12 bg-[#050508]" data-purpose="inventory-catalog" id="katalog">
<div class="max-w-6xl mx-auto">
<div class="text-center max-w-3xl mx-auto mb-16">
<h2 class="text-3xl md:text-4xl font-extrabold font-display tracking-tight text-white mb-4">
          Real Impact. <span class="text-purple-400">Katalog &amp; Inventaris Siap Pakai.</span>
</h2>
<p class="text-slate-400 text-sm md:text-base leading-relaxed">
          Eksplorasi berbagai kategori peralatan dan perangkat yang siap dipinjam kapan saja dengan kondisi terawat.
        </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
<div class="glass-card rounded-2xl p-6 border border-white/10 hover:border-purple-500/40 transition duration-300 flex flex-col justify-between">
<div>
<div class="inline-block px-2.5 py-1 rounded-md text-[10px] font-semibold uppercase tracking-wider bg-purple-500/20 text-purple-300 border border-purple-500/30 mb-4">
              Komputasi &amp; IT
            </div>
<h3 class="text-lg font-bold text-white mb-2">Elektronik &amp; Laptop</h3>
<p class="text-slate-400 text-xs leading-relaxed mb-4">
              Peralatan komputasi untuk ujian, presentasi, event, dan riset praktikum harian.
            </p>
<ul class="space-y-2 text-xs text-slate-300">
<li class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
<span>MacBook Pro M2 &amp; ThinkPad L14 (24 Unit)</span>
</li>
<li class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
<span>iPad Air Lab Komputer (40 Unit)</span>
</li>
<li class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
<span>Proyektor Laser Epson 4K (8 Unit)</span>
</li>
</ul>
</div>
<div class="mt-6 pt-4 border-t border-white/10 flex items-center justify-between text-xs">
<span class="text-slate-400">Total 72 Tersedia</span>
<a href="{{ route('katalog.inventaris') }}" class="text-[11px] font-bold text-purple-400 hover:text-purple-300 hover:translate-x-1 inline-block transition-all duration-300">Detail →</a>
</div>
</div>
<div class="glass-card rounded-2xl p-6 border border-white/10 hover:border-purple-500/40 transition duration-300 flex flex-col justify-between">
<div>
<div class="inline-block px-2.5 py-1 rounded-md text-[10px] font-semibold uppercase tracking-wider bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 mb-4">
              Broadcast &amp; Media
            </div>
<h3 class="text-lg font-bold text-white mb-2">Perlengkapan Multimedia</h3>
<p class="text-slate-400 text-xs leading-relaxed mb-4">
              Perangkat audio-visual profesional untuk liputan acara, podcast, dan konten dokumentasi.
            </p>
<ul class="space-y-2 text-xs text-slate-300">
<li class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
<span>Sony Alpha A7 IV + Lensa GM (6 Kit)</span>
</li>
<li class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
<span>Wireless Mic RØDE Go II (12 Set)</span>
</li>
<li class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
<span>DJI Mini 3 Pro Drone &amp; Gimbal (4 Unit)</span>
</li>
</ul>
</div>
<div class="mt-6 pt-4 border-t border-white/10 flex items-center justify-between text-xs">
<span class="text-slate-400">Total 22 Tersedia</span>
<a href="{{ route('katalog.inventaris') }}" class="text-[11px] font-bold text-purple-400 hover:text-purple-300 hover:translate-x-1 inline-block transition-all duration-300">Detail →</a>
</div>
</div>
<div class="glass-card rounded-2xl p-6 border border-white/10 hover:border-purple-500/40 transition duration-300 flex flex-col justify-between">
<div>
<div class="inline-block px-2.5 py-1 rounded-md text-[10px] font-semibold uppercase tracking-wider bg-violet-500/20 text-violet-300 border border-violet-500/30 mb-4">
              Ruang &amp; Riset
            </div>
<h3 class="text-lg font-bold text-white mb-2">Alat Kelas &amp; Laboratorium</h3>
<p class="text-slate-400 text-xs leading-relaxed mb-4">
              Instrumen laboratorium fisika/kimia, sensor IoT, serta audio portabel untuk kegiatan lapangan.
            </p>
<ul class="space-y-2 text-xs text-slate-300">
<li class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
<span>Kit Mikrokontroler Arduino &amp; ESP32 (50 Kit)</span>
</li>
<li class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
<span>Mikroskop Digital Biologi HD (15 Unit)</span>
</li>
<li class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
<span>Portable Speaker JBL EON ONE (5 Unit)</span>
</li>
</ul>
</div>
<div class="mt-6 pt-4 border-t border-white/10 flex items-center justify-between text-xs">
<span class="text-slate-400">Total 70 Tersedia</span>
<a href="{{ route('katalog.inventaris') }}" class="text-[11px] font-bold text-purple-400 hover:text-purple-300 hover:translate-x-1 inline-block transition-all duration-300">Detail →</a>
</div>
</div>
</div>
<div class="text-center">
<a href="{{ route('katalog.inventaris') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-bold text-sm text-white border border-purple-500/30 bg-purple-950/40 backdrop-blur-md hover:bg-purple-900/60 transition duration-300">
    Lihat Semua 250+ Inventaris →
</a>
</div>
</div>
</section>
<!-- END: SolutionsAndCatalogSection -->
<!-- BEGIN: BorrowingFormSection -->
<section id="ajukan" class="py-24 px-6 lg:px-12 border-t border-white/[0.06] bg-[#030305] relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom,_var(--tw-gradient-stops))] from-purple-900/10 via-transparent to-transparent pointer-events-none"></div>
        <div class="max-w-4xl mx-auto relative z-10">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold font-display tracking-tight text-white mb-4">
                    Formulir <span class="text-purple-400">Peminjaman Aset</span>
                </h2>
                <p class="text-slate-400 text-sm md:text-base">Lengkapi data diri dan detail barang yang ingin dipinjam. Permohonan akan langsung masuk ke Dashboard Admin.</p>
            </div>

            <!-- Notifikasi Sukses Jika Berhasil Disubmit -->
            @if(session('success'))
                <div id="success-alert" class="mb-8 p-5 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-center font-semibold text-sm shadow-[0_0_30px_rgba(16,185,129,0.2)] animate-pulse">
                    ✨ Success! Request successfully sent. Please wait a moment, your request is being processed to the Admin Dashboard...
                </div>
            @endif

            <!-- The Form dengan Loading State JavaScript -->
            <form action="{{ route('pinjam.store') }}" method="POST" id="loanForm" class="glass-card rounded-3xl p-8 md:p-12 border border-white/10 shadow-2xl relative z-20">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <!-- Nama Lengkap -->
                    <div class="flex flex-col space-y-2">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="nama" required placeholder="Masukkan nama lengkap Anda" class="form-input-dark w-full px-4 py-3.5 rounded-xl text-sm focus:ring-1 focus:ring-purple-500 bg-white/[0.03] border border-white/10 text-white">
                    </div>
                    
                    <!-- Nickname -->
                    <div class="flex flex-col space-y-2">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Nickname / Panggilan</label>
                        <input type="text" name="nickname" required placeholder="Nama panggilan" class="form-input-dark w-full px-4 py-3.5 rounded-xl text-sm focus:ring-1 focus:ring-purple-500 bg-white/[0.03] border border-white/10 text-white">
                    </div>
                    
                    <!-- WhatsApp -->
                    <div class="flex flex-col space-y-2">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Kontak WhatsApp</label>
                        <input type="text" name="whatsapp" required placeholder="Contoh: 081234567890" class="form-input-dark w-full px-4 py-3.5 rounded-xl text-sm focus:ring-1 focus:ring-purple-500 bg-white/[0.03] border border-white/10 text-white">
                    </div>
                    
                    <!-- Email -->
                    <div class="flex flex-col space-y-2">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Alamat Email</label>
                        <input type="email" name="email" required placeholder="email@contoh.com" class="form-input-dark w-full px-4 py-3.5 rounded-xl text-sm focus:ring-1 focus:ring-purple-500 bg-white/[0.03] border border-white/10 text-white">
                    </div>
                    
                    <!-- Tanggal Peminjaman (Bisa Diatur & Diklik) -->
                    <div class="flex flex-col space-y-2">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Tanggal &amp; Durasi Pinjam</label>
                        <div class="flex items-center gap-3">
                            <input type="date" name="tanggal_pinjam" required class="form-input-dark w-full px-4 py-3.5 rounded-xl text-sm focus:ring-1 focus:ring-purple-500 bg-white/[0.03] border border-white/10 text-white cursor-pointer">
                            <span class="text-slate-500">s/d</span>
                            <input type="date" name="tanggal_kembali" required class="form-input-dark w-full px-4 py-3.5 rounded-xl text-sm focus:ring-1 focus:ring-purple-500 bg-white/[0.03] border border-white/10 text-white cursor-pointer">
                        </div>
                    </div>
                    
                    <!-- Pilih Barang (Otomatis Menarik 20 Data dari Database) -->
                    <div class="flex flex-col space-y-2">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Pilih Barang yang Dipinjam</label>
                        <select name="barang_id" required class="form-input-dark w-full px-4 py-3.5 rounded-xl text-sm focus:ring-1 focus:ring-purple-500 bg-[#0B0B14] border border-white/10 text-white">
                            <option value="" disabled selected>Pilih dari 20+ aset/inventaris...</option>
                            @foreach(\App\Models\Item::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} (Stok: {{ $item->available_stock }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="flex flex-col space-y-2 mb-10">
                    <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Keterangan / Keperluan</label>
                    <textarea name="keterangan" rows="3" placeholder="Jelaskan secara singkat keperluan peminjaman aset ini..." class="form-input-dark w-full px-4 py-3.5 rounded-xl text-sm focus:ring-1 focus:ring-purple-500 bg-white/[0.03] border border-white/10 text-white resize-none"></textarea>
                </div>

                <!-- Tombol Submit dengan Efek Loading -->
                <button type="submit" id="submitBtn" class="w-full py-4 rounded-xl font-bold text-white bg-gradient-to-r from-purple-600 via-purple-500 to-indigo-600 shadow-glow-sm hover:shadow-glow-md hover:scale-[1.01] active:scale-95 transition-all duration-300 cursor-pointer flex items-center justify-center gap-2">
                    <span id="btnText">Kirim Permohonan Peminjaman</span>
                    <svg id="btnLoader" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>
            
            <!-- Script JavaScript untuk Efek Loading pas Disubmit -->
            <script>
                document.getElementById('loanForm').addEventListener('submit', function() {
                    const btn = document.getElementById('submitBtn');
                    const btnText = document.getElementById('btnText');
                    const btnLoader = document.getElementById('btnLoader');

                    // Ubah teks tombol dan tampilkan animasi muter (spinner)
                    btn.disabled = true;
                    btn.classList.add('opacity-75', 'cursor-not-allowed');
                    btnText.innerText = "Sending request, please wait...";
                    btnLoader.classList.remove('hidden');
                });
            </script>
        </div>
    </section>
<!-- END: BorrowingFormSection -->

<!-- BEGIN: SocialProofSection -->
<section class="py-20 px-6 lg:px-12 border-t border-white/[0.06] bg-[#080811]" data-purpose="social-proof" id="bantuan">
<div class="max-w-6xl mx-auto text-center">
<p class="text-xs font-semibold text-purple-400 uppercase tracking-widest mb-3">Dipercaya Komunitas Edukasi &amp; Korporasi</p>
<h2 class="text-2xl md:text-3xl font-extrabold font-display text-white mb-10">
        Digunakan oleh 40+ Sekolah Unggulan &amp; Perusahaan
      </h2>
<div class="flex flex-wrap items-center justify-center gap-6 md:gap-10 opacity-90">
<div class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/[0.03] border border-white/10">
<div class="w-9 h-9 rounded-full bg-gradient-to-tr from-purple-500 to-indigo-400 flex items-center justify-center text-xs font-bold text-white">
            SMK
          </div>
<div class="text-left">
<p class="text-xs font-bold text-white">SMK Telkom Sandhy</p>
<p class="text-[10px] text-slate-400">1,420+ Aset Terkelola</p>
</div>
</div>
<div class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/[0.03] border border-white/10">
<div class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-500 to-blue-400 flex items-center justify-center text-xs font-bold text-white">
            UI
          </div>
<div class="text-left">
<p class="text-xs font-bold text-white">Lab Riset Elektro</p>
<p class="text-[10px] text-slate-400">920+ Transaksi Sukses</p>
</div>
</div>
<div class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/[0.03] border border-white/10">
<div class="w-9 h-9 rounded-full bg-gradient-to-tr from-fuchsia-500 to-purple-500 flex items-center justify-center text-xs font-bold text-white">
            NT
          </div>
<div class="text-left">
<p class="text-xs font-bold text-white">Nusantara Tech Hub</p>
<p class="text-[10px] text-slate-400">100% Zero-Loss Aset</p>
</div>
</div>
<div class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/[0.03] border border-white/10">
<div class="w-9 h-9 rounded-full bg-gradient-to-tr from-violet-600 to-purple-400 flex items-center justify-center text-xs font-bold text-white">
            SMA
          </div>
<div class="text-left">
<p class="text-xs font-bold text-white">SMA Unggulan 1</p>
<p class="text-[10px] text-slate-400">Audit Berkala Otomatis</p>
</div>
</div>
</div>
</div>
</section>
<!-- END: SocialProofSection -->
<!-- BEGIN: MainFooter -->
<footer class="bg-[#030305] border-t border-white/[0.08] text-slate-400 text-xs py-12 px-6 lg:px-12" data-purpose="site-footer">
<div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
<div class="flex items-center gap-3">
<span class="text-lg font-bold font-display tracking-tight text-white">PinjamBarang<span class="text-purple-400">.</span></span>
<span class="text-slate-600">|</span>
<span>© 2026 PinjamBarang SaaS. Seluruh Hak Cipta Dilindungi.</span>
</div>
<div class="flex items-center gap-6">
<a class="hover:text-purple-300 transition-colors" href="#kebijakan">Kebijakan Privasi</a>
<a class="hover:text-purple-300 transition-colors" href="#syarat">Syarat &amp; Ketentuan</a>
<a class="hover:text-purple-300 transition-colors" href="#keamanan">Protokol Keamanan</a>
<a class="hover:text-purple-300 transition-colors" href="#kontak">Hubungi Admin</a>
</div>
<div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/[0.03] border border-white/10 text-[11px] text-slate-300">
<span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
<span>Semua Sistem Operasional</span>
</div>
</div>
</footer>
<!-- END: MainFooter -->
<!-- Interactive Scroll Behavior Script -->
<script data-purpose="navigation-interactivity">
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        const targetId = this.getAttribute('href');
        if (targetId && targetId !== '#') {
          const targetElem = document.querySelector(targetId);
          if (targetElem) {
            e.preventDefault();
            targetElem.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        }
      });
    });
  </script>
</body></html>preventDefault();
            targetElem.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        }
      });
    });
  </script>
</body></html>