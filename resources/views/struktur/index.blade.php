<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Struktur {{ $settings['nama_masjid'] ?? 'Masjid' }}
    </title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
        rel="stylesheet">

    {{-- Google Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">


    <style>

        /* =========================================================
           ROOT
        ========================================================= */

        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --primary-soft: #eef2ff;

            --dark: #0f172a;
            --text: #334155;
            --muted: #64748b;

            --white: #ffffff;
            --background: #f8fafc;

            --line: #cbd5e1;
            --line-dark: #94a3b8;

            --success: #10b981;

            --card-radius: 20px;
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
                radial-gradient(
                    circle at 5% 5%,
                    rgba(79, 70, 229, .08),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 95% 20%,
                    rgba(99, 102, 241, .06),
                    transparent 30%
                ),
                #f8fafc;

            color: var(--dark);

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
            font-family: 'Outfit', sans-serif;
        }


        /* =========================================================
           NAVBAR
        ========================================================= */

        .navbar-public {
            background: rgba(255, 255, 255, .90);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            border-bottom:
                1px solid rgba(226, 232, 240, .85);

            box-shadow:
                0 8px 30px rgba(15, 23, 42, .05);

            transition: .3s ease;
        }

        .navbar-brand {
            font-family: 'Outfit', sans-serif;

            font-weight: 800;

            color: var(--dark);

            letter-spacing: -.3px;
        }

        .navbar-brand i {
            color: var(--primary);
        }

        .nav-link {
            color: #64748b !important;

            font-weight: 600;

            padding:
                9px 15px !important;

            border-radius: 12px;

            transition:
                color .25s ease,
                background .25s ease,
                transform .25s ease;
        }

        .nav-link:hover {
            color: var(--primary) !important;

            background:
                rgba(79, 70, 229, .07);

            transform: translateY(-1px);
        }

        .nav-link.active {
            color: var(--primary) !important;

            background:
                rgba(79, 70, 229, .09);
        }


        /* =========================================================
           MAIN SECTION
        ========================================================= */

        .structure-section {
            position: relative;

            padding-top: 145px;
            padding-bottom: 100px;

            min-height: 100vh;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .structure-header {
            position: relative;

            max-width: 780px;

            margin: 0 auto;

            text-align: center;
        }

        .section-label {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            padding:
                8px 16px;

            background:
                rgba(79, 70, 229, .08);

            border:
                1px solid rgba(79, 70, 229, .10);

            color:
                var(--primary);

            border-radius:
                999px;

            font-size:
                11px;

            font-weight:
                800;

            letter-spacing:
                1.5px;

            text-transform:
                uppercase;

            box-shadow:
                0 5px 20px rgba(79, 70, 229, .05);
        }

        .section-label i {
            font-size: 14px;
        }

        .section-title {
            margin-top: 18px;
            margin-bottom: 12px;

            font-size:
                clamp(2.2rem, 4vw, 3.4rem);

            line-height: 1.05;

            font-weight: 800;

            letter-spacing: -1.2px;

            color: var(--dark);
        }

        .section-title span {
            color: var(--primary);
        }

        .section-description {
            max-width: 680px;

            margin:
                0 auto;

            color:
                var(--muted);

            font-size:
                14px;

            line-height:
                1.8;
        }


        /* =========================================================
           ORGANIZATION AREA
        ========================================================= */

        .organization-wrapper {
            position: relative;

            margin-top: 65px;
        }

        .organization-tree {
            width: 100%;

            overflow-x: auto;

            overflow-y: visible;

            padding:
                25px 30px 110px;

            scrollbar-width:
                thin;

            scrollbar-color:
                #cbd5e1 transparent;
        }

        .organization-tree::-webkit-scrollbar {
            height: 8px;
        }

        .organization-tree::-webkit-scrollbar-track {
            background: transparent;
        }

        .organization-tree::-webkit-scrollbar-thumb {
            background:
                #cbd5e1;

            border-radius:
                999px;
        }


        /* =========================================================
           ROOT / KETUA
        ========================================================= */

        .tree-root {
            position: relative;

            display: flex;

            justify-content: center;

            width: 100%;

            margin-bottom: 90px;
        }

        /*
         * Garis vertikal dari Ketua
         */
        .tree-root::after {
            content: "";

            position: absolute;

            left: 50%;

            bottom: -90px;

            width: 2px;

            height: 90px;

            background:
                linear-gradient(
                    to bottom,
                    var(--primary),
                    var(--line)
                );

            transform:
                translateX(-50%);

            z-index: 1;
        }


        /* =========================================================
           LEVEL CHILDREN
        ========================================================= */

        .children-wrapper {
            position: relative;

            width: 100%;
        }

        /*
         * Garis horizontal utama
         */
        .children-wrapper.multiple::before {
            content: "";

            position: absolute;

            top: 0;

            left: 12.5%;
            right: 12.5%;

            height: 2px;

            background:
                var(--line);

            z-index: 1;
        }


        /*
         * GRID
         */
        .tree-level {
            position: relative;

            display: grid;

            grid-template-columns:
                repeat(4, minmax(220px, 240px));

            justify-content: center;

            column-gap: 38px;

            row-gap: 85px;

            padding-top: 55px;
        }


        /* =========================================================
           CHILD ITEM
        ========================================================= */

        .child-item {
            position: relative;

            display: flex;

            justify-content: center;

            min-width: 0;
        }


        /*
         * Garis vertikal menuju child
         */
        .child-item::before {
            content: "";

            position: absolute;

            top: -55px;

            left: 50%;

            width: 2px;

            height: 55px;

            background:
                var(--line);

            transform:
                translateX(-50%);

            z-index: 1;
        }


        /*
         * Titik koneksi
         */
        .child-item::after {
            content: "";

            position: absolute;

            top: -59px;

            left: 50%;

            width: 10px;

            height: 10px;

            background:
                var(--white);

            border:
                2px solid var(--line-dark);

            border-radius:
                50%;

            transform:
                translateX(-50%);

            z-index: 3;
        }


        /* =========================================================
           TREE CARD
        ========================================================= */

        .tree-node {
            position: relative;

            width: 230px;

            min-width: 230px;

            overflow: hidden;

            background:
                rgba(255, 255, 255, .96);

            border:
                1px solid #e2e8f0;

            border-radius:
                var(--card-radius);

            box-shadow:
                0 10px 30px
                rgba(15, 23, 42, .06);

            transition:
                transform .3s ease,
                box-shadow .3s ease,
                border-color .3s ease;

            z-index: 2;
        }

        .tree-node::before {
            content: "";

            position: absolute;

            top: 0;
            left: 0;
            right: 0;

            height: 4px;

            background:
                linear-gradient(
                    90deg,
                    var(--primary),
                    #818cf8
                );

            opacity: .85;
        }

        .tree-node:hover {
            transform:
                translateY(-8px);

            border-color:
                rgba(79, 70, 229, .20);

            box-shadow:
                0 20px 45px
                rgba(79, 70, 229, .12);
        }


        /* =========================================================
           PHOTO
        ========================================================= */

        .tree-photo {
            display: block;

            width: 100%;

            height: 190px;

            object-fit: cover;

            background:
                #eef2ff;
        }

        .tree-photo-placeholder {
            width: 100%;

            height: 190px;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #eef2ff,
                    #e0e7ff
                );

            color:
                var(--primary);

            font-size:
                55px;
        }


        /* =========================================================
           NODE CONTENT
        ========================================================= */

        .node-content {
            padding:
                17px 15px 18px;

            text-align:
                center;
        }

        .node-position {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 6px;

            max-width: 100%;

            padding:
                6px 11px;

            background:
                var(--primary-soft);

            color:
                var(--primary);

            border-radius:
                999px;

            font-size:
                9px;

            font-weight:
                800;

            letter-spacing:
                .4px;

            text-transform:
                uppercase;

            margin-bottom:
                10px;
        }

        .node-position i {
            font-size:
                10px;
        }

        .node-name {
            margin:
                0 0 6px;

            color:
                var(--dark);

            font-size:
                17px;

            font-weight:
                800;

            line-height:
                1.25;
        }

        .node-description {
            margin:
                0;

            color:
                #94a3b8;

            font-size:
                10px;

            line-height:
                1.55;
        }


        /* =========================================================
           KETUA CARD SPECIAL
        ========================================================= */

        .tree-root .tree-node {
            width:
                270px;

            min-width:
                270px;

            border:
                2px solid
                rgba(79, 70, 229, .16);

            box-shadow:
                0 18px 50px
                rgba(79, 70, 229, .13);
        }

        .tree-root .tree-node::before {
            height:
                5px;

            background:
                linear-gradient(
                    90deg,
                    var(--primary-dark),
                    var(--primary),
                    #818cf8
                );
        }

        .tree-root .tree-photo,
        .tree-root .tree-photo-placeholder {
            height:
                230px;
        }

        .tree-root .node-content {
            padding:
                18px 16px 20px;
        }

        .tree-root .node-position {
            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    #6366f1
                );

            color:
                white;

            box-shadow:
                0 5px 15px
                rgba(79, 70, 229, .20);
        }

        .tree-root .node-name {
            font-size:
                21px;

            letter-spacing:
                -.3px;
        }

        .tree-root .node-description {
            font-size:
                11px;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .empty-state {
            max-width:
                520px;

            margin:
                30px auto;

            padding:
                45px 30px;

            background:
                rgba(255,255,255,.9);

            border:
                1px solid #e2e8f0;

            border-radius:
                22px;

            text-align:
                center;

            box-shadow:
                0 15px 35px
                rgba(15,23,42,.05);
        }

        .empty-state-icon {
            width:
                65px;

            height:
                65px;

            margin:
                0 auto 18px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                18px;

            background:
                var(--primary-soft);

            color:
                var(--primary);

            font-size:
                28px;
        }

        .empty-state h4 {
            margin-bottom:
                7px;

            font-weight:
                800;
        }

        .empty-state p {
            margin:
                0;

            color:
                var(--muted);

            font-size:
                13px;
        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 1150px) {

            .tree-level {
                grid-template-columns:
                    repeat(3, 230px);

                column-gap:
                    30px;
            }

            .children-wrapper.multiple::before {
                left:
                    calc(
                        16.66% + 35px
                    );

                right:
                    calc(
                        16.66% + 35px
                    );
            }
        }


        /* =========================================================
           TABLET SMALL
        ========================================================= */

        @media (max-width: 850px) {

            .structure-section {
                padding-top:
                    125px;
            }

            .tree-level {
                grid-template-columns:
                    repeat(2, 220px);

                column-gap:
                    30px;

                row-gap:
                    75px;
            }

            .children-wrapper.multiple::before {
                left:
                    25%;

                right:
                    25%;
            }

            .tree-node {
                width:
                    220px;

                min-width:
                    220px;
            }
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 600px) {

            .structure-section {
                padding-top:
                    105px;

                padding-bottom:
                    60px;
            }

            .section-title {
                font-size:
                    2.05rem;

                letter-spacing:
                    -.7px;
            }

            .section-description {
                padding:
                    0 10px;

                font-size:
                    13px;
            }

            .organization-wrapper {
                margin-top:
                    45px;
            }

            .organization-tree {
                padding:
                    20px 15px 90px;
            }

            .tree-root {
                margin-bottom:
                    75px;
            }

            .tree-root::after {
                bottom:
                    -75px;

                height:
                    75px;
            }

            .tree-root .tree-node {
                width:
                    220px;

                min-width:
                    220px;
            }

            .tree-root .tree-photo,
            .tree-root .tree-photo-placeholder {
                height:
                    200px;
            }

            .tree-level {
                min-width:
                    455px;

                grid-template-columns:
                    repeat(2, 210px);

                column-gap:
                    25px;

                row-gap:
                    65px;

                padding-top:
                    50px;
            }

            .tree-node {
                width:
                    210px;

                min-width:
                    210px;
            }

            .tree-photo,
            .tree-photo-placeholder {
                height:
                    175px;
            }

            .children-wrapper.multiple::before {
                left:
                    25%;

                right:
                    25%;
            }

            .child-item::before {
                height:
                    50px;

                top:
                    -50px;
            }

            .child-item::after {
                top:
                    -54px;
            }
        }


        /* =========================================================
           VERY SMALL MOBILE
        ========================================================= */

        @media (max-width: 400px) {

            .section-title {
                font-size:
                    1.85rem;
            }

            .section-label {
                font-size:
                    9px;

                padding:
                    7px 12px;
            }

            .tree-root .tree-node {
                width:
                    205px;

                min-width:
                    205px;
            }

            .tree-root .tree-photo,
            .tree-root .tree-photo-placeholder {
                height:
                    185px;
            }

            .tree-level {
                min-width:
                    425px;

                grid-template-columns:
                    repeat(2, 195px);

                column-gap:
                    20px;
            }

            .tree-node {
                width:
                    195px;

                min-width:
                    195px;
            }

            .tree-photo,
            .tree-photo-placeholder {
                height:
                    160px;
            }

            .node-name {
                font-size:
                    15px;
            }

            .node-position {
                font-size:
                    8px;
            }
        }

    </style>

</head>


<body>


{{-- =============================================================
     NAVBAR
============================================================= --}}

<nav class="navbar navbar-expand-lg navbar-public fixed-top">

    <div class="container py-2">

        <a
            class="navbar-brand d-flex align-items-center gap-2"
            href="{{ route('welcome') }}"
        >

            <i class="bi bi-mosque fs-4"></i>

            {{ $settings['nama_masjid'] ?? 'Masjid Nabawi' }}

        </a>


        <button
            class="navbar-toggler border-0 shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarPublic"
            aria-controls="navbarPublic"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >

            <i class="bi bi-list fs-2"></i>

        </button>


        <div
            class="collapse navbar-collapse"
            id="navbarPublic"
        >

            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

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



{{-- =============================================================
     MAIN CONTENT
============================================================= --}}

<section class="structure-section">

    <div class="container">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="structure-header">

            <span class="section-label">

                <i class="bi bi-diagram-3-fill"></i>

                Pengurus Masjid

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

        <div class="organization-wrapper">

            <div class="organization-tree">

                @forelse($strukturs as $root)

                    {{-- =================================================
                         ROOT / KETUA
                    ================================================== --}}

                    <div class="tree-root">

                        <div class="tree-node">

                            @if($root->foto)

                                <img
                                    src="{{ asset('storage/' . $root->foto) }}"
                                    class="tree-photo"
                                    alt="{{ $root->nama }}"
                                    loading="lazy"
                                >

                            @else

                                <div class="tree-photo-placeholder">

                                    <i class="bi bi-person"></i>

                                </div>

                            @endif


                            <div class="node-content">

                                <div class="node-position">

                                    <i class="bi bi-award-fill"></i>

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

                        <div class="children-wrapper multiple">

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

                                                    <i class="bi bi-person-badge"></i>

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



{{-- =============================================================
     BOOTSTRAP JS
============================================================= --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>