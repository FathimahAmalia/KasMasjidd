<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Struktur {{ $settings['nama_masjid'] ?? 'Masjid' }}
    </title>


    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- Bootstrap Icons --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >


    {{-- Google Font --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <style>

        /* =========================================================
           ROOT
        ========================================================= */

        :root {

            --primary: #4f46e5;
            --primary-soft: #eef2ff;

            --dark: #111827;
            --text: #334155;
            --muted: #64748b;

            --background: #f8fafc;

            --border: #e5e7eb;

        }


        /* =========================================================
           GLOBAL
        ========================================================= */

        * {
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {

            margin: 0;

            min-height: 100vh;

            background:
                #f8fafc;

            color:
                var(--dark);

            font-family:
                'Plus Jakarta Sans',
                sans-serif;

            overflow-x: hidden;

        }


        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {

            font-family:
                'Outfit',
                sans-serif;

        }


        /* =========================================================
           NAVBAR
        ========================================================= */

        .navbar-public {

            background:
                rgba(255,255,255,.96);

            border-bottom:
                1px solid #edf0f4;

            box-shadow:
                0 2px 15px rgba(15,23,42,.035);

            backdrop-filter:
                blur(15px);

            -webkit-backdrop-filter:
                blur(15px);

        }


        .navbar-brand {

            font-family:
                'Outfit',
                sans-serif;

            font-weight:
                800;

            font-size:
                15px;

            color:
                #1e293b;

        }


        .navbar-brand i {

            color:
                var(--primary);

        }


        .nav-link {

            color:
                #64748b !important;

            font-size:
                12px;

            font-weight:
                600;

            padding:
                9px 13px !important;

            border-radius:
                10px;

            transition:
                .2s ease;

        }


        .nav-link:hover {

            color:
                var(--primary) !important;

            background:
                #f1f5f9;

        }


        .nav-link.active {

            color:
                var(--primary) !important;

            background:
                #eef2ff;

        }


        /* =========================================================
           MAIN
        ========================================================= */

        .structure-section {

            min-height:
                100vh;

            padding-top:
                105px;

            padding-bottom:
                90px;

        }


        /* =========================================================
           HEADER
        ========================================================= */

        .structure-header {

            text-align:
                center;

            max-width:
                720px;

            margin:
                0 auto;

        }


        .section-label {

            display:
                inline-flex;

            align-items:
                center;

            gap:
                6px;

            padding:
                7px 13px;

            background:
                #eef2ff;

            color:
                #4f46e5;

            border-radius:
                999px;

            font-size:
                10px;

            font-weight:
                800;

            letter-spacing:
                .8px;

            text-transform:
                uppercase;

        }


        .section-title {

            margin:
                14px 0 8px;

            font-size:
                clamp(28px, 4vw, 42px);

            font-weight:
                800;

            letter-spacing:
                -.8px;

            color:
                #111827;

        }


        .section-title span {

            color:
                var(--primary);

        }


        .section-description {

            margin:
                0 auto;

            max-width:
                600px;

            color:
                #94a3b8;

            font-size:
                13px;

            line-height:
                1.7;

        }


        /* =========================================================
           ORGANIZATION
        ========================================================= */

        .organization-tree {

            margin-top:
                55px;

            width:
                100%;

            overflow-x:
                auto;

            padding:
                10px 25px 50px;

        }


        /*
         * Wrapper supaya seluruh struktur tetap berada
         * di tengah halaman.
         */

        .organization-content {

            width:
                max-content;

            min-width:
                100%;

        }


        /* =========================================================
           KETUA
        ========================================================= */

        .tree-root {

            display:
                flex;

            justify-content:
                center;

            width:
                100%;

            margin-bottom:
                34px;

        }


        /* =========================================================
           ROOT CARD
        ========================================================= */

        .tree-root .tree-node {

            width:
                286px;

            min-width:
                286px;

            height:
                278px;

            background:
                #ffffff;

            border:
                1px solid #dedede;

            border-radius:
                12px;

            box-shadow:
                0 3px 10px rgba(15,23,42,.045);

            display:
                flex;

            flex-direction:
                column;

            align-items:
                center;

            padding:
                22px 20px 18px;

            transition:
                .25s ease;

        }


        .tree-root .tree-node:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 8px 25px rgba(15,23,42,.08);

        }


        /* =========================================================
           ROOT PHOTO
        ========================================================= */

        .tree-root .tree-photo,
        .tree-root .tree-photo-placeholder {

            width:
                128px;

            height:
                128px;

            border-radius:
                50%;

            object-fit:
                cover;

            flex-shrink:
                0;

        }


        .tree-root .tree-photo-placeholder {

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                #e2e8f0;

            color:
                #94a3b8;

            font-size:
                48px;

        }


        /* =========================================================
           ROOT CONTENT
        ========================================================= */

        .tree-root .node-content {

            text-align:
                center;

            padding:
                13px 0 0;

        }


        .tree-root .node-position {

            margin-bottom:
                8px;

            color:
                #64748b;

            font-size:
                11px;

            font-weight:
                700;

            letter-spacing:
                .2px;

            text-transform:
                uppercase;

        }


        .tree-root .node-name {

            margin:
                0;

            color:
                #111827;

            font-size:
                16px;

            font-weight:
                800;

        }


        .tree-root .node-description {

            display:
                none;

        }


        /* =========================================================
           CHILDREN
        ========================================================= */

        .children-wrapper {

            width:
                100%;

            display:
                flex;

            justify-content:
                center;

        }


        .tree-level {

            display:
                flex;

            justify-content:
                center;

            align-items:
                flex-start;

            gap:
                18px;

            width:
                max-content;

            margin:
                0 auto;

        }


        /* =========================================================
           CHILD CARD
        ========================================================= */

        .child-item {

            width:
                173px;

            min-width:
                173px;

        }


        .child-item .tree-node {

            width:
                173px;

            min-width:
                173px;

            height:
                252px;

            background:
                #ffffff;

            border:
                1px solid #dedede;

            border-radius:
                11px;

            box-shadow:
                0 3px 9px rgba(15,23,42,.04);

            display:
                flex;

            flex-direction:
                column;

            align-items:
                center;

            padding:
                20px 12px 15px;

            transition:
                .25s ease;

        }


        .child-item .tree-node:hover {

            transform:
                translateY(-4px);

            box-shadow:
                0 10px 25px rgba(15,23,42,.08);

            border-color:
                #d8dce5;

        }


        /* =========================================================
           CHILD PHOTO
        ========================================================= */

        .child-item .tree-photo,
        .child-item .tree-photo-placeholder {

            width:
                105px;

            height:
                105px;

            border-radius:
                50%;

            object-fit:
                cover;

            flex-shrink:
                0;

        }


        .child-item .tree-photo-placeholder {

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                #e2e8f0;

            color:
                #94a3b8;

            font-size:
                38px;

        }


        /* =========================================================
           CHILD CONTENT
        ========================================================= */

        .child-item .node-content {

            width:
                100%;

            text-align:
                center;

            padding:
                14px 3px 0;

        }


        .child-item .node-position {

            margin-bottom:
                8px;

            color:
                #64748b;

            font-size:
                9px;

            font-weight:
                600;

            line-height:
                1.35;

            text-transform:
                uppercase;

        }


        .child-item .node-name {

            margin:
                0;

            color:
                #111827;

            font-size:
                13px;

            font-weight:
                700;

            line-height:
                1.35;

        }


        .child-item .node-description {

            display:
                none;

        }


        /* =========================================================
           REMOVE ALL CONNECTING LINES
        ========================================================= */

        .tree-root::after,
        .children-wrapper::before,
        .child-item::before,
        .child-item::after {

            display:
                none !important;

            content:
                none !important;

        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .empty-state {

            width:
                min(500px, 100%);

            margin:
                50px auto;

            padding:
                40px 30px;

            text-align:
                center;

            background:
                #ffffff;

            border:
                1px solid #e5e7eb;

            border-radius:
                15px;

            box-shadow:
                0 5px 20px rgba(15,23,42,.04);

        }


        .empty-state-icon {

            width:
                60px;

            height:
                60px;

            margin:
                0 auto 15px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                #eef2ff;

            color:
                #4f46e5;

            border-radius:
                15px;

            font-size:
                25px;

        }


        .empty-state h4 {

            margin:
                0 0 7px;

            font-size:
                18px;

            font-weight:
                800;

        }


        .empty-state p {

            margin:
                0;

            color:
                #94a3b8;

            font-size:
                12px;

        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 900px) {

            .organization-tree {

                justify-content:
                    flex-start;

                padding-left:
                    20px;

                padding-right:
                    20px;

            }

            .organization-content {

                min-width:
                    100%;

            }

            .tree-level {

                gap:
                    15px;

            }

        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 600px) {

            .structure-section {

                padding-top:
                    90px;

                padding-bottom:
                    50px;

            }


            .section-title {

                font-size:
                    30px;

            }


            .section-description {

                padding:
                    0 15px;

                font-size:
                    12px;

            }


            .organization-tree {

                margin-top:
                    40px;

                padding:
                    10px 15px 40px;

            }


            .tree-root .tree-node {

                width:
                    250px;

                min-width:
                    250px;

                height:
                    255px;

            }


            .tree-root .tree-photo,
            .tree-root .tree-photo-placeholder {

                width:
                    110px;

                height:
                    110px;

            }


            .tree-level {

                gap:
                    14px;

            }


            .child-item,
            .child-item .tree-node {

                width:
                    160px;

                min-width:
                    160px;

            }


            .child-item .tree-node {

                height:
                    230px;

                padding:
                    18px 10px;

            }


            .child-item .tree-photo,
            .child-item .tree-photo-placeholder {

                width:
                    95px;

                height:
                    95px;

            }

        }


    </style>

</head>


<body>


{{-- =========================================================
     NAVBAR
========================================================= --}}

<nav class="navbar navbar-expand-lg navbar-public fixed-top">

    <div class="container py-2">


        <a
            class="navbar-brand d-flex align-items-center gap-2"
            href="{{ route('welcome') }}"
        >

            <i class="bi bi-mosque fs-5"></i>

            {{ $settings['nama_masjid'] ?? 'Masjid Nabawi' }}

        </a>


        <button
            class="navbar-toggler border-0 shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarPublic"
        >

            <i class="bi bi-list fs-2"></i>

        </button>


        <div
            class="collapse navbar-collapse"
            id="navbarPublic"
        >

            <ul
                class="navbar-nav ms-auto align-items-lg-center gap-lg-1"
            >

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('welcome') }}"
                    >
                        Beranda
                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('informasi.index') }}"
                    >
                        Informasi
                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link active"
                        href="{{ route('struktur.index') }}"
                    >
                        Struktur
                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('kegiatan.index') }}"
                    >
                        Kegiatan
                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>



{{-- =========================================================
     CONTENT
========================================================= --}}

<section class="structure-section">

    <div class="container">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="structure-header">

            <span class="section-label">

                <i class="bi bi-diagram-3-fill"></i>

                Struktur Pengurus

            </span>


            <h1 class="section-title">

                Mengenal
                <span>Pengurus Kami</span>

            </h1>


            <p class="section-description">

                Berikut adalah susunan pengurus
                {{ $settings['nama_masjid'] ?? 'Masjid Nabawi' }}
                yang bertugas menjaga amanah dan memberikan
                pelayanan terbaik bagi jamaah.

            </p>

        </div>



        {{-- =====================================================
             ORGANIZATION TREE
        ====================================================== --}}

        <div class="organization-tree">

            <div class="organization-content">

                @forelse($strukturs as $root)


                    {{-- =================================================
                         KETUA / ROOT
                    ================================================== --}}

                    <div class="tree-root">

                        <div class="tree-node">


                            @if($root->foto)

                                <img
                                    src="{{ asset('storage/' . $root->foto) }}"
                                    class="tree-photo"
                                    alt="{{ $root->nama }}"
                                >

                            @else

                                <div class="tree-photo-placeholder">

                                    <i class="bi bi-person"></i>

                                </div>

                            @endif


                            <div class="node-content">


                                <div class="node-position">

                                    {{ $root->jabatan }}

                                </div>


                                <h3 class="node-name">

                                    {{ $root->nama }}

                                </h3>


                                @if($root->keterangan)

                                    <p class="node-description">

                                        {{ $root->keterangan }}

                                    </p>

                                @endif


                            </div>

                        </div>

                    </div>



                    {{-- =================================================
                         CHILDREN
                    ================================================== --}}

                    @if($root->childrenRecursive->count())


                        <div class="children-wrapper">


                            <div class="tree-level">


                                @foreach($root->childrenRecursive as $child)


                                    <div class="child-item">


                                        <div class="tree-node">


                                            @if($child->foto)

                                                <img
                                                    src="{{ asset('storage/' . $child->foto) }}"
                                                    class="tree-photo"
                                                    alt="{{ $child->nama }}"
                                                    loading="lazy"
                                                >

                                            @else

                                                <div class="tree-photo-placeholder">

                                                    <i class="bi bi-person"></i>

                                                </div>

                                            @endif


                                            <div class="node-content">


                                                <div class="node-position">

                                                    {{ $child->jabatan }}

                                                </div>


                                                <h3 class="node-name">

                                                    {{ $child->nama }}

                                                </h3>


                                                @if($child->keterangan)

                                                    <p class="node-description">

                                                        {{ $child->keterangan }}

                                                    </p>

                                                @endif


                                            </div>

                                        </div>


                                    </div>


                                @endforeach


                            </div>


                        </div>


                    @endif


                @empty


                    {{-- =================================================
                         EMPTY STATE
                    ================================================== --}}

                    <div class="empty-state">


                        <div class="empty-state-icon">

                            <i class="bi bi-diagram-3"></i>

                        </div>


                        <h4>

                            Belum Ada Struktur Pengurus

                        </h4>


                        <p>

                            Data struktur pengurus belum tersedia
                            saat ini.

                        </p>


                    </div>


                @endforelse


            </div>

        </div>


    </div>

</section>



{{-- =========================================================
     BOOTSTRAP JS
========================================================= --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>