@extends('layouts.app')

@section('title', 'Scan Struk')

@section('content')
<style>
@verbatim
.ss{--card:#fff;--ink:#0f172a;--muted:#475569;--soft:#64748b;--line:#e5e9f0;--navy:#0f172a;--green:#16a34a;--green-dark:#15803d;--green-soft:#dcfce7;--yellow:#eab308;--yellow-soft:#fef9c3;--red:#ef4444;--red-soft:#fee2e2;--blue:#2563eb;--blue-soft:#dbeafe;--panel:#f8fafc;--radius:18px;--shadow:0 1px 2px rgba(15,23,42,.04),0 12px 30px -16px rgba(15,23,42,.14);font-family:'Plus Jakarta Sans',system-ui,sans-serif;font-size:14px;line-height:1.45;color:var(--ink);padding-bottom:48px}
.ss *{box-sizing:border-box}
.ss button,.ss input,.ss select{font:inherit;color:inherit}
.ss button{cursor:pointer}
.ss svg{display:block}
.ss [hidden]{display:none!important}
.ss .icon{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:1.9;stroke-linecap:round;stroke-linejoin:round;flex:none}

/* header */
.ss .head{display:flex;justify-content:space-between;align-items:flex-end;gap:16px;flex-wrap:wrap;margin-bottom:22px}
.ss h1{font-size:28px;font-weight:800;letter-spacing:-.5px}
.ss .sub{color:var(--muted);margin-top:6px;font-size:15px;max-width:640px}
.ss .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;border-radius:999px;padding:11px 22px;font-weight:700;border:1px solid var(--line);background:#fff;transition:.15s}
.ss .btn:hover{background:#f6f7f9;border-color:#d5dbe5}
.ss .btn.primary{background:var(--navy);border-color:var(--navy);color:#fff}
.ss .btn.primary:hover{background:#1e293b}
.ss .btn.green{background:var(--green);border-color:var(--green);color:#fff}
.ss .btn.green:hover{background:var(--green-dark)}
.ss .btn.sm{padding:8px 14px;font-size:13px}
.ss .btn:disabled{opacity:.55;cursor:not-allowed}
.ss .btn.full{width:100%;padding:13px 22px}

/* kartu */
.ss .card{background:var(--card);border:1px solid var(--line);border-radius:var(--radius);box-shadow:var(--shadow);padding:26px}
.ss .ch{display:flex;gap:14px;align-items:center}
.ss .ch .chip-ic{width:42px;height:42px;border-radius:12px;display:grid;place-items:center;flex:none;background:var(--green-soft);color:var(--green-dark)}
.ss .ch .chip-ic.navy{background:var(--navy);color:#fff}
.ss .ch .chip-ic.blue{background:var(--blue-soft);color:var(--blue)}
.ss .ch .chip-ic.yellow{background:var(--yellow-soft);color:#a16207}
.ss .ch h2{font-size:17px;font-weight:700;line-height:1.25}
.ss .hint{color:var(--soft);font-size:13px;margin-top:3px}

/* stepper */
.ss .steps{display:flex;align-items:center;background:#fff;border:1px solid var(--line);border-radius:var(--radius);box-shadow:var(--shadow);padding:18px 26px;margin-bottom:20px}
.ss .step{flex:1;display:flex;align-items:center;gap:12px;min-width:0}
.ss .step:last-child{flex:0 0 auto}
.ss .step:not(:last-child)::after{content:'';flex:1;height:2px;background:var(--line);margin:0 18px;border-radius:2px;min-width:16px}
.ss .step.is-done:not(:last-child)::after{background:var(--green)}
.ss .step .n{width:38px;height:38px;border-radius:50%;background:#f1f5f9;color:var(--soft);display:grid;place-items:center;font-weight:800;flex:none;transition:.2s}
.ss .step .lbl{display:flex;flex-direction:column;min-width:0;white-space:nowrap}
.ss .step .lbl b{font-size:14px;font-weight:700;color:var(--soft)}
.ss .step .lbl small{font-size:12.5px;color:#94a3b8}
.ss .step.is-active .n{background:var(--navy);color:#fff;box-shadow:0 0 0 5px rgba(15,23,42,.09)}
.ss .step.is-active .lbl b,.ss .step.is-done .lbl b{color:var(--ink)}
.ss .step.is-done .n{background:var(--green);color:#fff}

.ss .top{display:grid;grid-template-columns:1.15fr 1fr;gap:20px;margin-bottom:20px;align-items:start}
.ss .side{display:flex;flex-direction:column;gap:20px}

/* dropzone */
.ss .drop{margin-top:20px;border:2px dashed #c7d0dd;border-radius:16px;background:linear-gradient(180deg,#fbfcfd,#f4f7fa);padding:44px 20px;text-align:center;transition:.2s}
.ss .drop:hover{border-color:#94a3b8}
.ss .drop.over{border-color:var(--green);background:var(--green-soft)}
.ss .drop .big{width:64px;height:64px;border-radius:18px;background:var(--navy);color:#fff;display:grid;place-items:center;margin:0 auto 16px;box-shadow:0 10px 20px -8px rgba(15,23,42,.45)}
.ss .drop .big .icon{width:28px;height:28px}
.ss .drop strong{display:block;font-size:17px}
.ss .drop p{color:var(--soft);margin:6px 0 18px}
.ss .fmt{display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-top:18px}
.ss .fmt span{font-size:12px;font-weight:600;color:var(--muted);background:#fff;border:1px solid var(--line);border-radius:999px;padding:4px 12px}
.ss .pv{margin-top:20px}
.ss .pv-box{background:#eef2f6;border-radius:14px;padding:16px;display:flex;justify-content:center;max-height:540px;overflow:auto;border:1px solid var(--line)}
.ss .pv-wrap{position:relative;display:inline-block;max-width:100%;line-height:0}
.ss .pv-wrap canvas{max-width:100%;height:auto;display:block;border-radius:6px;background:#fff;box-shadow:0 6px 18px -8px rgba(15,23,42,.35)}
.ss .pv-wrap.crop{cursor:crosshair;touch-action:none}
.ss .crop-sel{position:absolute;border:2px solid var(--green);background:rgba(22,163,74,.15);box-shadow:0 0 0 9999px rgba(15,23,42,.35);pointer-events:none}
.ss .tools{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px}

/* status */
.ss .st{display:flex;gap:14px;align-items:flex-start;margin-top:18px;background:var(--panel);border:1px solid var(--line);border-radius:14px;padding:16px}
.ss .st .ic{width:42px;height:42px;border-radius:12px;display:grid;place-items:center;flex:none}
.ss .st .ic.idle{background:#e9eef4;color:var(--soft)}
.ss .st .ic.ok{background:var(--green-soft);color:var(--green-dark)}
.ss .st .ic.bad{background:var(--red-soft);color:var(--red)}
.ss .st .ic.run{background:var(--blue-soft);color:var(--blue)}
.ss .st .t{font-size:15.5px;font-weight:700}
.ss .st p{color:var(--muted);margin-top:4px;line-height:1.5}
.ss .prog{height:8px;background:#e2e8f0;border-radius:999px;overflow:hidden;margin-top:12px}
.ss .prog i{display:block;height:100%;width:0;background:var(--blue);border-radius:999px;transition:width .25s}
.ss .spin{width:20px;height:20px;border:3px solid #bfdbfe;border-top-color:var(--blue);border-radius:50%;animation:ssspin .8s linear infinite}
@keyframes ssspin{to{transform:rotate(360deg)}}
.ss .st-actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:12px}
.ss .linkbtn{background:none;border:0;color:var(--navy);font-weight:700;text-decoration:underline;text-underline-offset:3px;padding:0;margin-top:14px;font-size:13.5px}

.ss .tips ul{list-style:none;margin:18px 0 0;padding:0;display:flex;flex-direction:column;gap:12px}
.ss .tips li{display:flex;gap:12px;color:var(--muted);line-height:1.5;align-items:flex-start}
.ss .tips li .icon{width:22px;height:22px;padding:4px;border-radius:50%;background:var(--green-soft);color:var(--green-dark);stroke-width:2.6;margin-top:1px}

/* hasil */
.ss .res{margin-bottom:20px}
.ss .rh-left{display:flex;gap:16px;align-items:center}
.ss .thumb{width:60px;height:80px;border-radius:10px;object-fit:cover;border:1px solid var(--line);background:#f1f5f9;flex:none}
.ss .res h2{font-size:18px;font-weight:700}
.ss .panel{background:var(--panel);border:1px solid var(--line);border-radius:14px;padding:18px;margin-top:20px}
.ss .form{display:grid;grid-template-columns:1.4fr 1fr 1fr 1fr;gap:14px;margin-bottom:14px}
.ss .fr label{display:block;font-size:13px;font-weight:600;color:var(--muted);margin-bottom:6px}
.ss .in{width:100%;border:1px solid #dbe1ea;background:#fff;border-radius:10px;padding:10px 12px;outline:0;min-width:0;transition:.15s}
.ss .in:focus{border-color:var(--navy);box-shadow:0 0 0 3px rgba(15,23,42,.08)}
.ss .in:disabled{background:#f1f5f9;color:#94a3b8}
.ss .check{display:flex;align-items:center;gap:9px;color:var(--muted);font-weight:500}
.ss .check input{width:16px;height:16px;accent-color:var(--navy)}
.ss .pills{display:flex;gap:10px;flex-wrap:wrap;margin:18px 0 4px}
.ss .pill{display:inline-flex;align-items:center;gap:6px;border-radius:999px;padding:6px 14px;font-size:13px;font-weight:600;background:#eef2f6;color:var(--muted)}
.ss .pill .icon{width:15px;height:15px}
.ss .pill.g{background:var(--green-soft);color:#166534}.ss .pill.y{background:var(--yellow-soft);color:#854d0e}.ss .pill.r{background:var(--red-soft);color:#991b1b}.ss .pill.b{background:var(--blue-soft);color:#1e40af}
.ss .note{display:flex;gap:10px;align-items:flex-start;background:var(--yellow-soft);color:#854d0e;border-radius:12px;padding:12px 14px;margin:12px 0;font-size:13.5px;line-height:1.5}
.ss .note.info{background:var(--blue-soft);color:#1e40af}
.ss .tw{overflow-x:auto;margin-top:14px;border:1px solid var(--line);border-radius:14px}
.ss table{width:100%;border-collapse:collapse;min-width:1040px}
.ss th{text-align:left;color:var(--muted);font-weight:700;font-size:12.5px;text-transform:uppercase;letter-spacing:.4px;padding:13px 10px;background:var(--panel);border-bottom:1px solid var(--line);white-space:nowrap}
.ss td{padding:10px;border-bottom:1px solid var(--line);vertical-align:top}
.ss tbody tr:last-child td{border-bottom:0}
.ss tbody tr:hover td{background:#fbfcfd}
.ss tr.warn td{background:#fffbeb}
.ss tr.nonfood td .in[data-f=name]{color:var(--soft)}
.ss tr.nonfood td:nth-child(4),.ss tr.nonfood td:nth-child(6){opacity:.45}
.ss .namecell{display:flex;gap:8px;align-items:center}
.ss .warn-ic{color:#ca8a04;flex:none}
.ss .qty{display:flex;gap:6px}
.ss .qty input{width:72px}.ss .qty select{width:84px}
.ss .pfx{position:relative}
.ss .pfx span{position:absolute;left:11px;top:50%;transform:translateY(-50%);color:var(--soft);font-weight:600;font-size:13px}
.ss .pfx .in{padding-left:34px;min-width:116px}
.ss td small{display:block;color:var(--soft);font-size:12px;margin-top:5px}
.ss .cf{display:inline-flex;align-items:center;gap:5px;border-radius:999px;padding:5px 11px;font-size:12.5px;font-weight:700;white-space:nowrap}
.ss .cf .icon{width:14px;height:14px}
.ss .cf.ok{background:var(--green-soft);color:#166534}.ss .cf.mid{background:var(--yellow-soft);color:#854d0e}.ss .cf.low{background:var(--red-soft);color:#991b1b}
.ss .icon-btn{width:36px;height:36px;border-radius:10px;border:1px solid var(--line);background:#fff;display:inline-grid;place-items:center;color:var(--soft)}
.ss .icon-btn:hover{color:var(--red);background:var(--red-soft);border-color:#fecaca}
.ss .actions{display:flex;gap:10px;flex-wrap:wrap;justify-content:flex-end;align-items:center;margin-top:22px;background:var(--panel);border:1px solid var(--line);border-radius:14px;padding:16px 18px}
.ss .actions .left{margin-right:auto}
.ss .finish{display:flex;gap:14px;align-items:center;justify-content:space-between;flex-wrap:wrap;background:var(--green-soft);color:#14532d;border-radius:14px;padding:16px 20px;margin-top:16px}
.ss .finish a{color:#14532d;font-weight:700}

/* riwayat */
.ss .hist{display:flex;flex-direction:column;gap:10px;margin-top:18px}
.ss .hrow{display:flex;gap:16px;align-items:center;padding:14px 16px;border:1px solid var(--line);border-radius:14px;flex-wrap:wrap;transition:.15s}
.ss .hrow:hover{background:#fbfcfd;border-color:#d5dbe5}
.ss .hrow .thumb{width:42px;height:56px}
.ss .hinfo{flex:1;min-width:200px}
.ss .hinfo b{display:block;font-size:15px}
.ss .hinfo span{color:var(--soft);font-size:13px}
.ss .htotal{font-weight:800;min-width:120px;text-align:right;font-size:15px}
.ss .hchips{display:flex;gap:6px;flex-wrap:wrap}
.ss .empty{text-align:center;color:var(--soft);padding:30px 0}

.ss .toast{position:fixed;bottom:24px;left:50%;transform:translate(-50%,90px);background:var(--navy);color:#fff;padding:12px 22px;border-radius:999px;font-weight:600;transition:transform .3s;z-index:80;max-width:90vw}
.ss .toast.show{transform:translate(-50%,0)}

@media (max-width:1100px){.ss .top{grid-template-columns:1fr}.ss .form{grid-template-columns:1fr 1fr}}
@media (max-width:760px){.ss .steps{padding:14px}.ss .step .lbl{display:none}.ss .step.is-active .lbl{display:flex}.ss .step:not(:last-child)::after{margin:0 8px}.ss .form{grid-template-columns:1fr}.ss h1{font-size:24px}}
@endverbatim
</style>

<div class="ss">
  <div class="head">
    <div>
      <h1>Scan Struk</h1>
      <p class="sub">Upload foto struk belanja, cek hasil bacanya, lalu masukkan ke stok dapur dan anggaran sekaligus.</p>
    </div>
    <button class="btn" id="btnDemo" type="button"><svg class="icon" viewBox="0 0 24 24"><path d="M5 3h14v18l-3-2-2 2-2-2-2 2-2-2-3 2z"/><path d="M9 8h6M9 12h6"/></svg>Coba dengan contoh struk</button>
  </div>

  <div class="steps" id="stepper">
    <div class="step"><span class="n">1</span><span class="lbl"><b>Upload</b><small>Pilih foto struk</small></span></div>
    <div class="step"><span class="n">2</span><span class="lbl"><b>Proses OCR</b><small>Baca teks struk</small></span></div>
    <div class="step"><span class="n">3</span><span class="lbl"><b>Cek &amp; edit</b><small>Koreksi hasil</small></span></div>
    <div class="step"><span class="n">4</span><span class="lbl"><b>Simpan</b><small>Stok &amp; anggaran</small></span></div>
  </div>

  <div class="top">
    <!-- Upload & preview -->
    <section class="card">
      <div class="ch"><div class="chip-ic navy"><svg class="icon" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg></div><div><h2>Foto struk</h2><p class="hint">Unggah foto struk belanja yang jelas dan lurus.</p></div></div>

      <div class="drop" id="drop">
        <div class="big"><svg class="icon" viewBox="0 0 24 24"><path d="M12 16V4M7 9l5-5 5 5"/><path d="M4 16v3a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-3"/></svg></div>
        <strong>Tarik &amp; lepas foto struk di sini</strong>
        <p>atau pilih file dari perangkatmu</p>
        <button class="btn primary" type="button" id="btnPick">Pilih file</button>
        <div class="fmt"><span>JPG</span><span>PNG</span><span>WEBP</span><span>Maks. 10 MB</span></div>
        <input type="file" id="file" accept="image/*" hidden>
      </div>

      <div class="pv" id="pv" hidden>
        <div class="pv-box"><div class="pv-wrap" id="pvWrap"><canvas id="cv"></canvas><div class="crop-sel" id="cropSel" hidden></div></div></div>
        <div class="tools">
          <button class="btn sm" type="button" id="btnRotL"><svg class="icon" viewBox="0 0 24 24"><path d="M3 12a9 9 0 1 0 3-6.7"/><path d="M3 4v5h5"/></svg>Putar kiri</button>
          <button class="btn sm" type="button" id="btnRotR"><svg class="icon" viewBox="0 0 24 24"><path d="M21 12a9 9 0 1 1-3-6.7"/><path d="M21 4v5h-5"/></svg>Putar kanan</button>
          <button class="btn sm" type="button" id="btnCrop"><svg class="icon" viewBox="0 0 24 24"><path d="M6 2v14a2 2 0 0 0 2 2h14M2 6h14a2 2 0 0 1 2 2v14"/></svg><span>Crop</span></button>
          <button class="btn sm" type="button" id="btnCropCancel" hidden>Batal crop</button>
          <button class="btn sm" type="button" id="btnReset">Reset</button>
          <button class="btn sm" type="button" id="btnChange">Ganti foto</button>
        </div>
        <button class="btn green full" type="button" id="btnProcess" style="margin-top:14px">Proses Struk</button>
      </div>
    </section>

    <!-- Status & tips -->
    <div class="side">
      <section class="card" id="statusCard"></section>
      <section class="card tips">
        <div class="ch"><div class="chip-ic yellow"><svg class="icon" viewBox="0 0 24 24"><path d="M9 18h6M10 22h4"/><path d="M12 2a7 7 0 0 0-4 12.7c.6.5 1 1.2 1 2V17h6v-.3c0-.8.4-1.5 1-2A7 7 0 0 0 12 2z"/></svg></div><div><h2>Tips foto yang baik</h2><p class="hint">Hasil foto bagus, hasil bacaan lebih akurat.</p></div></div>
        <ul>
          <li><svg class="icon" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>Foto di tempat terang dan merata. Hindari bayangan dan pantulan lampu.</li>
          <li><svg class="icon" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>Luruskan struk di permukaan datar, jangan kusut atau terlipat.</li>
          <li><svg class="icon" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>Foto dari atas (tegak lurus) dan pastikan seluruh struk masuk bingkai.</li>
          <li><svg class="icon" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>Pastikan tulisan tajam dan tidak terpotong. Pakai putar dan crop untuk merapikan.</li>
        </ul>
      </section>
    </div>
  </div>

  <!-- Hasil OCR -->
  <section class="card res" id="resultCard" hidden>
    <div class="res-head">
      <div class="rh-left">
        <img class="thumb" id="resThumb" alt="Struk" hidden>
        <div class="ch"><div class="chip-ic"><svg class="icon" viewBox="0 0 24 24"><path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/><path d="M14 3v5h5M9 13h6M9 17h6"/></svg></div><div>
          <h2>Hasil pembacaan struk</h2>
          <p class="hint">OCR bisa salah baca. Periksa dan koreksi nama, jumlah, dan harga sebelum disimpan.</p>
        </div></div>
      </div>
    </div>

    <div class="panel"><div class="form">
      <div class="fr"><label for="fStore">Nama toko</label><input class="in" id="fStore" placeholder="mis. Indomaret"></div>
      <div class="fr"><label for="fDate">Tanggal belanja</label><input class="in" type="date" id="fDate"></div>
      <div class="fr"><label for="fTotal">Total belanja (Rp)</label><input class="in" type="number" min="0" step="100" id="fTotal"></div>
      <div class="fr"><label for="fCat">Kategori belanja</label><select class="in" id="fCat"></select></div>
    </div>
    <label class="check"><input type="checkbox" id="fSplit">Pecah transaksi per kategori barang saat dicatat ke anggaran</label></div>

    <div class="pills" id="pills"></div>
    <div class="note" id="noteMismatch" hidden></div>

    <div class="tw">
      <table>
        <thead><tr><th style="min-width:230px">Nama barang</th><th>Jumlah</th><th>Harga</th><th>Kategori</th><th>Jenis</th><th>Saran kadaluwarsa</th><th>Keyakinan</th><th></th></tr></thead>
        <tbody id="tbody"></tbody>
      </table>
    </div>
    <button class="btn sm" type="button" id="btnAddRow" style="margin-top:14px">+ Tambah baris</button>

    <div class="note info" style="margin-top:16px"><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8h.01M11 12h1v5h1"/></svg><span>Barang <b>non-makanan</b> (sabun, plastik, dll.) tidak ikut masuk stok, tapi tetap dihitung di total belanja.</span></div>

    <div class="actions">
      <div class="left"><button class="btn" type="button" id="btnNew">Scan struk lain</button></div>
      <button class="btn" type="button" id="btnStock">Simpan ke Stok Dapur</button>
      <button class="btn" type="button" id="btnBudget">Catat ke Anggaran</button>
      <button class="btn primary" type="button" id="btnBoth">Simpan ke Stok &amp; Anggaran</button>
    </div>

    <div class="finish" id="doneBox" hidden>
      <span><b>Selesai!</b> Struk sudah tersimpan di riwayat.</span>
      <span><a href="{{ url('/kelola-stok') }}">Lihat stok dapur</a> &nbsp;·&nbsp; <a href="{{ url('/anggaran') }}">Lihat anggaran</a></span>
    </div>
  </section>

  <!-- Riwayat -->
  <section class="card" id="historyCard">
    <div class="ch"><div class="chip-ic blue"><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div><div><h2>Riwayat struk</h2><p class="hint">Struk yang pernah kamu scan. Klik "Lihat" untuk membuka dan mengedit ulang.</p></div></div>
    <div class="hist" id="hist"></div>
  </section>

  <div class="toast" id="toast"></div>
</div>

<script>
@verbatim
(function(){
/* ================= UTIL ================= */
const $ = id => document.getElementById(id);
const esc = s => String(s==null?'':s).replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
const rp = n => 'Rp ' + Math.round(+n||0).toLocaleString('id-ID');
const pad = n => String(n).padStart(2,'0');
const isoDate = d => `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`;
const todayISO = () => isoDate(new Date());
const addDays = n => { const d=new Date(); d.setDate(d.getDate()+n); return isoDate(d); };
const fmtDate = s => { if(!s) return '-'; const [y,m,d]=s.split('-').map(Number); return new Date(y,m-1,d).toLocaleDateString('id-ID',{day:'numeric',month:'short',year:'numeric'}); };
function toast(msg){const t=$('toast');t.textContent=msg;t.classList.add('show');clearTimeout(toast._t);toast._t=setTimeout(()=>t.classList.remove('show'),2600)}

const CATS  = ['Sayuran','Buah','Daging & Ikan','Telur & Susu','Bumbu','Bahan Pokok','Lainnya'];
const UNITS = ['pcs','kg','gram','liter','ml','pak','butir','ikat'];
const IC = {
  warn:'<svg class="icon" viewBox="0 0 24 24"><path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/><path d="M12 9v4M12 17h.01"/></svg>',
  check:'<svg class="icon" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>',
  x:'<svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="m15 9-6 6M9 9l6 6"/></svg>',
  img:'<svg class="icon" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/></svg>',
  trash:'<svg class="icon" viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2M6 6l1 14h10l1-14"/></svg>'
};

/* ================= PENYIMPANAN =================
   Sementara memakai localStorage. Untuk menyambungkan ke Laravel,
   ganti isi API.saveStock / API.saveTransactions dengan fetch() ke controller-mu. */
const LS = {
  get(k,def){ try{ const v=localStorage.getItem(k); return v?JSON.parse(v):def }catch(e){ return def } },
  set(k,v){ try{ localStorage.setItem(k,JSON.stringify(v)); return true }catch(e){ return false } }
};
const csrf = (document.querySelector('meta[name="csrf-token"]')||{}).content || '';
const API = {
  async saveStock(items){
    // TODO: await fetch('/stok/bulk',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf},body:JSON.stringify({items})})
    const cur = LS.get('pantrify.stock',[]); LS.set('pantrify.stock',cur.concat(items)); return true;
  },
  async saveTransactions(txs){
    // TODO: await fetch('/anggaran/transaksi',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf},body:JSON.stringify({transactions:txs})})
    const cur = LS.get('pantrify.transactions',[]); LS.set('pantrify.transactions',cur.concat(txs)); return true;
  }
};

/* ================= KAMUS BAHAN ================= */
// [kata kunci, kategori, lokasi, hari kadaluwarsa, satuan]
const FOOD = [
  [['telur'],'Telur & Susu','Kulkas',21,'butir'],
  [['uht'],'Telur & Susu','Rak Kering',150],
  [['susu','keju','yoghurt','yogurt','yakult','mentega','butter','margarin','krim','cream'],'Telur & Susu','Kulkas',14],
  [['cabai','cabe','jahe','kunyit','lengkuas','serai','daun jeruk'],'Bumbu','Kulkas',10],
  [['bawang','kemiri'],'Bumbu','Rak Kering',30],
  [['garam','merica','lada','ketumbar','kecap','saus','sambal','royco','masako','penyedap','kaldu','santan','terasi','bumbu','cuka'],'Bumbu','Rak Kering',180],
  [['bayam','kangkung','sawi','pakcoy','selada','kemangi'],'Sayuran','Kulkas',3,'ikat'],
  [['brokoli','wortel','kol','kubis','timun','mentimun','buncis','terong','tomat','paprika','jagung','labu','seledri','kacang panjang','tauge','jamur'],'Sayuran','Kulkas',7],
  [['kentang','ubi','singkong'],'Sayuran','Rak Kering',21],
  [['apel','jeruk','anggur','semangka','melon','pir','kiwi','stroberi','strawberry','blueberry'],'Buah','Kulkas',10],
  [['pisang','mangga','pepaya','alpukat','nanas','salak','jambu','durian','rambutan','manggis'],'Buah','Rak Kering',5],
  [['bakso','sosis','nugget','kornet'],'Daging & Ikan','Freezer',90],
  [['ayam','sapi','daging','kambing','iga','fillet','fillet'],'Daging & Ikan','Freezer',60,'gram'],
  [['ikan','udang','cumi','salmon','tuna','lele','bandeng','kakap','tongkol','dori','kerang'],'Daging & Ikan','Freezer',60,'gram'],
  [['tahu','tempe'],'Bahan Pokok','Kulkas',3],
  [['roti'],'Bahan Pokok','Rak Kering',5],
  [['beras'],'Bahan Pokok','Rak Kering',180,'kg'],
  [['tepung','gula','minyak','mie','mi','indomie','pasta','spaghetti','makaroni','kopi','teh','sereal','oat','sagu','maizena','kacang'],'Bahan Pokok','Rak Kering',180],
  [['air mineral','aqua','minuman','jus','soda','biskuit','snack','coklat','cokelat','permen','keripik','wafer'],'Lainnya','Rak Kering',120]
];
const NONFOOD = ['sabun','shampo','sampo','deterjen','detergen','rinso','molto','downy','pewangi','pelembut','plastik','kantong','kresek','tisu','tissue','pasta gigi','odol','sikat','pembalut','popok','diaper','baterai','lampu','korek','rokok','pulpen','sunlight','pembersih','lysol','wipol','stella','trash','spons','sponge','alumunium','aluminium','cling wrap','tas belanja','masker','sanitizer','pencuci','pengharum','obat nyamuk','baygon','minyak angin'];
function matchFood(name){
  const n = ' ' + String(name).toLowerCase().replace(/[^a-z0-9 ]/g,' ').replace(/\s+/g,' ') + ' ';
  if(NONFOOD.some(k=>n.includes(' '+k))) return {non:true};
  for(const [kws,cat,loc,days,unit] of FOOD){
    if(kws.some(k=>n.includes(' '+k+' ')||n.includes(' '+k))) return {cat,loc,days,unit};
  }
  return null;
}
function enrich(it){
  const m = matchFood(it.name);
  if(m && m.non){ Object.assign(it,{food:false,cat:'Lainnya',loc:'',expiry:'',matched:true}); }
  else if(m){ Object.assign(it,{food:true,cat:m.cat,loc:m.loc,expiry:addDays(m.days),matched:true}); if(m.unit && (!it.unit||it.unit==='pcs')) it.unit=m.unit; }
  else Object.assign(it,{food:true,cat:'Lainnya',loc:'Rak Kering',expiry:addDays(14),matched:false});
  return it;
}
const mkItem = (name,qty,price,conf,unit) => enrich({name,qty:qty||1,unit:unit||'pcs',price:price||0,conf:conf==null?100:conf,edited:false,touched:false});

/* ================= STATE ================= */
let state = freshState();
function freshState(){ return {hasImage:false,status:'idle',progress:0,stage:'',error:'',store:'',date:todayISO(),total:0,totalTouched:false,cat:'Lainnya',catTouched:false,split:false,items:[],thumb:'',recId:null,savedStock:false,savedBudget:false}; }

/* ================= STEPPER & STATUS ================= */
function setStep(n){
  [...$('stepper').children].forEach((el,i)=>{ const done=i+1<n; el.className='step'+(done?' is-done':i+1===n?' is-active':''); el.querySelector('.n').textContent=done?'✓':String(i+1); });
}
function renderStatus(){
  const s=state.status, el=$('statusCard'); let h='<div class="ch"><div class="chip-ic blue"><svg class="icon" viewBox="0 0 24 24"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div><div><h2>Status proses</h2><p class="hint">Pantau tahap pembacaan struk.</p></div></div>';
  if(s==='idle') h+=`<div class="st"><div class="ic idle">${IC.img}</div><div><div class="t">Belum ada struk</div><p>Upload foto struk di sebelah kiri untuk memulai.</p></div></div>`;
  if(s==='ready') h+=`<div class="st"><div class="ic idle">${IC.check}</div><div><div class="t">Foto siap diproses</div><p>Rapikan dulu dengan putar atau crop bila perlu, lalu klik <b>Proses Struk</b>.</p></div></div>`;
  if(s==='processing') h+=`<div class="st"><div class="ic run"><div class="spin"></div></div><div style="flex:1"><div class="t">Sedang memproses…</div><p>${esc(state.stage||'Membaca struk')}</p><div class="prog"><i style="width:${Math.round(state.progress)}%"></i></div></div></div>`;
  if(s==='success'){ const w=state.items.filter(isWarn).length;
    h+=`<div class="st"><div class="ic ok">${IC.check}</div><div><div class="t">Berhasil dibaca</div><p>${state.items.length} item terbaca${w?`, <b>${w} item perlu dicek</b> (ditandai ikon peringatan)`:''}. Periksa dan koreksi di bagian hasil.</p></div></div>`; }
  if(s==='failed') h+=`<div class="st"><div class="ic bad">${IC.x}</div><div><div class="t">Gagal membaca struk</div><p>${esc(state.error||'Teks pada foto tidak terbaca.')} Coba foto ulang yang lebih jelas, atau isi manual.</p></div></div>
    <div class="st-actions"><button class="btn sm" type="button" data-act="retry">Coba lagi</button><button class="btn sm primary" type="button" data-act="manual">Input manual</button></div>`;
  if(s!=='failed' && s!=='processing') h+=`<button class="linkbtn" type="button" data-act="manual">Tidak ada foto? Input manual</button>`;
  el.innerHTML=h;
}
$('statusCard').addEventListener('click',e=>{
  const b=e.target.closest('[data-act]'); if(!b) return;
  if(b.dataset.act==='retry') startProcess(false);
  if(b.dataset.act==='manual') startManual();
});

/* ================= UPLOAD & PREVIEW ================= */
const cv=$('cv'), ctx=cv.getContext('2d'), orig=document.createElement('canvas');
const drop=$('drop'), fileIn=$('file');
$('btnPick').onclick=()=>fileIn.click();
$('btnChange').onclick=()=>fileIn.click();
fileIn.addEventListener('change',()=>{ if(fileIn.files[0]) loadFile(fileIn.files[0]); fileIn.value=''; });
['dragenter','dragover'].forEach(ev=>drop.addEventListener(ev,e=>{e.preventDefault();drop.classList.add('over')}));
['dragleave','drop'].forEach(ev=>drop.addEventListener(ev,e=>{e.preventDefault();drop.classList.remove('over')}));
drop.addEventListener('drop',e=>{ const f=e.dataTransfer.files[0]; if(f) loadFile(f); });
drop.addEventListener('click',e=>{ if(e.target===drop) fileIn.click(); });

function loadFile(file){
  if(!file.type.startsWith('image/')) return toast('File harus berupa gambar (JPG, PNG, WEBP).');
  if(file.size>10*1024*1024) return toast('Ukuran file maksimal 10 MB.');
  const url=URL.createObjectURL(file), img=new Image();
  img.onload=()=>{
    const max=1800, sc=Math.min(1,max/Math.max(img.width,img.height));
    cv.width=Math.round(img.width*sc); cv.height=Math.round(img.height*sc);
    ctx.fillStyle='#fff'; ctx.fillRect(0,0,cv.width,cv.height); ctx.drawImage(img,0,0,cv.width,cv.height);
    URL.revokeObjectURL(url); imageReady();
  };
  img.onerror=()=>{ URL.revokeObjectURL(url); toast('Gambar tidak bisa dibuka. Coba file lain.'); };
  img.src=url;
}
function imageReady(){
  orig.width=cv.width; orig.height=cv.height; orig.getContext('2d').drawImage(cv,0,0);
  state.hasImage=true; state.status='ready'; cancelCrop();
  drop.hidden=true; $('pv').hidden=false;
  $('resultCard').hidden=true; setStep(1); renderStatus();
}
function rotate(dir){
  const t=document.createElement('canvas'); t.width=cv.height; t.height=cv.width;
  const c=t.getContext('2d'); c.translate(t.width/2,t.height/2); c.rotate(dir*Math.PI/2); c.drawImage(cv,-cv.width/2,-cv.height/2);
  cv.width=t.width; cv.height=t.height; ctx.drawImage(t,0,0);
}
$('btnRotL').onclick=()=>{cancelCrop();rotate(-1)};
$('btnRotR').onclick=()=>{cancelCrop();rotate(1)};
$('btnReset').onclick=()=>{cancelCrop();cv.width=orig.width;cv.height=orig.height;ctx.drawImage(orig,0,0)};

/* crop: tarik area di atas gambar, lalu klik "Terapkan crop" */
let cropMode=false, sel=null, startPt=null;
const wrap=$('pvWrap'), selEl=$('cropSel');
function pt(e){ const r=cv.getBoundingClientRect(); return {x:Math.max(0,Math.min(e.clientX-r.left,r.width)),y:Math.max(0,Math.min(e.clientY-r.top,r.height))}; }
function cancelCrop(){ cropMode=false; sel=null; startPt=null; wrap.classList.remove('crop'); selEl.hidden=true; $('btnCropCancel').hidden=true; $('btnCrop').querySelector('span').textContent='Crop'; }
$('btnCrop').onclick=()=>{
  if(!cropMode){ cropMode=true; wrap.classList.add('crop'); $('btnCropCancel').hidden=false; $('btnCrop').querySelector('span').textContent='Terapkan crop'; toast('Tarik area struk yang ingin dipertahankan.'); return; }
  if(!sel||sel.w<20||sel.h<20) return toast('Tarik area yang lebih besar dulu.');
  const r=cv.getBoundingClientRect(), k=cv.width/r.width;
  const sx=Math.round(sel.x*k), sy=Math.round(sel.y*k), sw=Math.round(sel.w*k), sh=Math.round(sel.h*k);
  const t=document.createElement('canvas'); t.width=sw; t.height=sh; t.getContext('2d').drawImage(cv,sx,sy,sw,sh,0,0,sw,sh);
  cv.width=sw; cv.height=sh; ctx.drawImage(t,0,0); cancelCrop();
};
$('btnCropCancel').onclick=cancelCrop;
wrap.addEventListener('pointerdown',e=>{ if(!cropMode) return; startPt=pt(e); wrap.setPointerCapture(e.pointerId); });
wrap.addEventListener('pointermove',e=>{
  if(!cropMode||!startPt) return; const p=pt(e);
  sel={x:Math.min(startPt.x,p.x),y:Math.min(startPt.y,p.y),w:Math.abs(p.x-startPt.x),h:Math.abs(p.y-startPt.y)};
  Object.assign(selEl.style,{left:sel.x+'px',top:sel.y+'px',width:sel.w+'px',height:sel.h+'px'}); selEl.hidden=false;
});
wrap.addEventListener('pointerup',()=>{ startPt=null; });

/* ================= OCR ================= */
let tessPromise=null;
function loadTesseract(){
  if(window.Tesseract) return Promise.resolve();
  if(tessPromise) return tessPromise;
  tessPromise=new Promise((res,rej)=>{
    const s=document.createElement('script'); s.src='https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js';
    s.onload=res; s.onerror=()=>{tessPromise=null;rej(new Error('Mesin OCR gagal dimuat. Periksa koneksi internet.'))}; document.head.appendChild(s);
  });
  return tessPromise;
}
function getLines(data){
  let L=[];
  if(Array.isArray(data.lines)&&data.lines.length) L=data.lines.map(l=>({text:l.text,conf:l.confidence}));
  else if(Array.isArray(data.blocks)) data.blocks.forEach(b=>(b.paragraphs||[]).forEach(p=>(p.lines||[]).forEach(l=>L.push({text:l.text,conf:l.confidence}))));
  if(!L.length&&data.text) L=data.text.split('\n').map(t=>({text:t,conf:data.confidence||60}));
  return L.map(l=>({text:String(l.text||'').replace(/\s+/g,' ').trim(),conf:Math.round(l.conf||0)})).filter(l=>l.text);
}
const STAGE={'loading tesseract core':'Memuat mesin OCR…','initializing tesseract':'Menyiapkan OCR…','loading language traineddata':'Mengunduh data bahasa…','initializing api':'Menyiapkan OCR…','recognizing text':'Membaca teks pada struk…'};

async function startProcess(demo){
  if(state.status==='processing') return;
  if(!demo && !state.hasImage) return toast('Upload foto struk dulu.');
  state.status='processing'; state.progress=0; state.stage='Menyiapkan…'; state.error='';
  setStep(2); renderStatus(); $('btnProcess').disabled=true;
  try{
    let lines;
    if(demo){ lines = await fakeOCR(); }
    else{
      await loadTesseract();
      const t=document.createElement('canvas'); t.width=cv.width; t.height=cv.height;
      const c=t.getContext('2d'); c.filter='grayscale(1) contrast(1.35)'; c.drawImage(cv,0,0);
      const out=await Tesseract.recognize(t,'ind',{logger:m=>{ state.progress=Math.max(state.progress,(m.progress||0)*100); state.stage=STAGE[m.status]||m.status; renderStatus(); }});
      lines=getLines(out.data);
    }
    const parsed = demo ? DEMO_PARSED() : parseReceipt(lines);
    if(!parsed.items.length) throw new Error('Tidak ada barang yang terbaca dari foto.');
    applyParsed(parsed); state.status='success'; setStep(3); showResult(); renderStatus();
    $('resultCard').scrollIntoView({behavior:'smooth',block:'start'});
  }catch(err){
    state.status='failed'; state.error=err&&err.message?err.message:''; renderStatus();
  }finally{ $('btnProcess').disabled=false; }
}
$('btnProcess').onclick=()=>startProcess(false);

/* ---- parser teks struk ---- */
const SKIP=/(sub\s?total|total|tunai|cash|kembali|bayar|ppn|pajak|dpp|diskon|hemat|kasir|cashier|struk|trx|telp|tel\.|npwp|terima kasih|thank|debit|kredit|qris|member|poin|point|alamat|jl\.|jalan|kode|harga jual|www|\.com|ovo|gopay)/i;
function toNum(t){
  if(/^\d{1,3}([.,]\d{3})+$/.test(t)) return parseInt(t.replace(/[.,]/g,''),10);
  if(/^\d{1,3}([.,]\d{3})+[.,]\d{2}$/.test(t)) return parseInt(t.slice(0,-3).replace(/[.,]/g,''),10);
  if(/^\d+[.,]\d{1,2}$/.test(t)) return parseFloat(t.replace(',','.'));
  return parseInt(t,10);
}
const NUMRE=/\d{1,3}(?:[.,]\d{3})+(?:[.,]\d{2})?|\d+(?:[.,]\d+)?/g;
const letters=s=>(s.match(/[A-Za-z]/g)||[]).length;
const titleCase=s=>s.toLowerCase().replace(/\b[a-z]/g,c=>c.toUpperCase());
function cleanName(t){
  return t.replace(/\d+(?:[.,]\d+)*\s*[xX×@]\s*/g,' ').replace(/\d{1,3}(?:[.,]\d{3})+(?:[.,]\d{2})?/g,' ').replace(/^\d{4,}\s*/,'').replace(/[^A-Za-z0-9 .\-\/&%']/g,' ').replace(/\s+/g,' ').trim();
}
function parseReceipt(lines){
  const items=[]; let pending=null, total=0, date='', store='';
  // toko
  for(const l of lines.slice(0,6)){ if(letters(l.text)>=3 && !/(jl\.|jalan|telp|npwp|struk|kasir)/i.test(l.text)){ store=titleCase(l.text.replace(/[^A-Za-z0-9 .&'-]/g,' ').replace(/\s+/g,' ').trim()); break; } }
  // tanggal
  for(const l of lines){
    let m=l.text.match(/(\d{1,2})[\/\-.](\d{1,2})[\/\-.](\d{2,4})/);
    if(m){ let [_,d,mo,y]=m; y=+y; if(y<100) y+=2000; if(+mo>=1&&+mo<=12&&+d>=1&&+d<=31){ date=`${y}-${pad(+mo)}-${pad(+d)}`; break; } }
    m=l.text.match(/(\d{4})[\/\-.](\d{1,2})[\/\-.](\d{1,2})/);
    if(m&&+m[2]>=1&&+m[2]<=12){ date=`${m[1]}-${pad(+m[2])}-${pad(+m[3])}`; break; }
  }
  // total
  const cands=[], subs=[];
  lines.forEach(l=>{ const v=(l.text.match(NUMRE)||[]).map(toNum).filter(n=>n>=100);
    if(!v.length) return;
    if(/sub\s?total/i.test(l.text)) subs.push(v[v.length-1]);
    else if(/total|jumlah/i.test(l.text)) cands.push(v[v.length-1]); });
  total = cands.length?Math.max(...cands):(subs.length?Math.max(...subs):0);
  // item
  for(const l of lines){
    if(SKIP.test(l.text)) { pending=null; continue; }
    const toks=l.text.match(NUMRE)||[], vals=toks.map(toNum), prices=vals.filter(n=>n>=100);
    const name=cleanName(l.text);
    if(!prices.length){ pending = letters(l.text)>=3 ? {name,conf:l.conf} : null; continue; }
    let qty=1, price=prices[prices.length-1];
    const qm=l.text.match(/(\d+(?:[.,]\d+)?)\s*[xX×@]/);
    let nm=name;
    if(qm){ qty=parseFloat(qm[1].replace(',','.'))||1; if(prices.length===1&&qty>1) price=qty*prices[0]; }
    else { const t=nm.match(/\s(\d{1,2})$/); if(t&&prices.length>=2){ qty=+t[1]; nm=nm.replace(/\s\d{1,2}$/,''); } }
    let conf=l.conf;
    if(letters(nm)<3 && pending){ nm=pending.name; conf=Math.min(conf,pending.conf); }
    pending=null;
    if(letters(nm)<2) continue;
    if(nm.length<3) conf=Math.min(conf,50);
    items.push({name:titleCase(nm),qty,price,conf});
  }
  return {store,date,total,items};
}
function applyParsed(p){
  state.store=p.store||''; state.date=p.date||todayISO(); state.total=p.total||0; state.totalTouched=false;
  state.items=p.items.map(i=>mkItem(i.name,i.qty,i.price,i.conf));
  state.catTouched=false; state.savedStock=false; state.savedBudget=false; state.recId=null;
  state.thumb=makeThumb(); autoCat();
}
function makeThumb(){
  try{ if(!state.hasImage) return ''; const w=140,h=Math.round(cv.height*w/cv.width), t=document.createElement('canvas'); t.width=w;t.height=h; t.getContext('2d').drawImage(cv,0,0,w,h); return t.toDataURL('image/jpeg',.5); }catch(e){ return ''; }
}

/* ---- contoh struk (demo) ---- */
const DEMO_LINES=['INDOMARET KEBON JERUK','JL. KEBON JERUK RAYA NO. 12','',null,'Susu UHT Full Cream 1L  2 x 18.500   37.000','Telur Ayam 10 Butir      28.500','Dada Ayam Fillet 500g    39.000','Wortel Lokal 1kg         14.000','Bawang Putih 250g        12.500','Beras Premium 5kg        72.000','Sunlight Jeruk Nipis 750ml 19.500','Kantong Plastik             500','Pisang Cavendish 1 sisir 18.000','Kecap Manis 275ml        12.000','','TOTAL                   253.000','TUNAI                   300.000'];
function drawDemo(){
  const lines=DEMO_LINES.map(l=>l===null?new Date().toLocaleDateString('id-ID').replace(/\//g,'/'):l);
  cv.width=560; cv.height=70+lines.length*30; ctx.fillStyle='#fff'; ctx.fillRect(0,0,cv.width,cv.height);
  ctx.fillStyle='#111'; ctx.font='18px monospace'; lines.forEach((l,i)=>ctx.fillText(l,16,40+i*30));
}
const DEMO_PARSED=()=>({store:'Indomaret Kebon Jeruk',date:todayISO(),total:253000,items:[
  {name:'Susu UHT Full Cream 1L',qty:2,price:37000,conf:96},{name:'Telur Ayam 10 Butir',qty:1,price:28500,conf:92},
  {name:'Dada Ayam Fillet 500g',qty:1,price:39000,conf:88},{name:'Wortel Lokal 1kg',qty:1,price:14000,conf:71},
  {name:'Bawang Putih 250g',qty:1,price:12500,conf:90},{name:'Beras Premium 5kg',qty:1,price:72000,conf:95},
  {name:'Sunlight Jeruk Nipis 750ml',qty:1,price:19500,conf:93},{name:'Kantong Plastik',qty:1,price:500,conf:45},
  {name:'Pisang Cavendish',qty:1,price:18000,conf:67},{name:'Kecap Manis 275ml',qty:1,price:12000,conf:84}]});
function fakeOCR(){
  return new Promise(res=>{
    const stages=['Memuat mesin OCR…','Menyiapkan OCR…','Membaca teks pada struk…']; let p=0;
    const t=setInterval(()=>{ p+=8; state.progress=Math.min(p,100); state.stage=stages[Math.min(2,Math.floor(p/35))]; renderStatus(); if(p>=100){clearInterval(t);res([]);} },110);
  });
}
$('btnDemo').onclick=()=>{
  drawDemo(); orig.width=cv.width; orig.height=cv.height; orig.getContext('2d').drawImage(cv,0,0);
  state.hasImage=true; drop.hidden=true; $('pv').hidden=false; cancelCrop();
  startProcess(true);
};

/* ================= MANUAL ================= */
function startManual(){
  state.status='idle'; state.store=''; state.date=todayISO(); state.total=0; state.totalTouched=false; state.catTouched=false;
  state.items=[blankItem()]; state.thumb=''; state.recId=null; state.savedStock=false; state.savedBudget=false;
  renderStatus(); setStep(3); showResult(); $('resultCard').scrollIntoView({behavior:'smooth',block:'start'});
}
function blankItem(){ return {name:'',qty:1,unit:'pcs',price:0,cat:'Lainnya',food:true,loc:'Rak Kering',expiry:addDays(14),conf:100,edited:true,touched:false,matched:true}; }

/* ================= HASIL & EDIT ================= */
const isWarn = it => !it.edited && it.conf<70;
const isUnknown = it => !it.edited && !it.matched;
function autoCat(){
  if(state.catTouched) return;
  const sum={}; state.items.filter(i=>i.food).forEach(i=>sum[i.cat]=(sum[i.cat]||0)+i.price);
  const top=Object.keys(sum).sort((a,b)=>sum[b]-sum[a])[0]; state.cat=top||'Lainnya';
  $('fCat').value=state.cat;
}
const opts=(list,sel)=>list.map(o=>`<option ${o===sel?'selected':''}>${esc(o)}</option>`).join('');
function confBadge(it){
  if(it.edited) return `<span class="cf ok">${IC.check}Dikoreksi</span>`;
  const c=it.conf, cls=c>=85?'ok':c>=70?'mid':'low';
  return `<span class="cf ${cls}">${c<70?IC.warn:IC.check}${c}%</span>${!it.matched?'<small>Jenis belum dikenali, cek kategori</small>':''}`;
}
function rowHTML(it,i){
  return `<tr data-i="${i}" class="${it.food?'':'nonfood'} ${isWarn(it)?'warn':''}">
    <td><div class="namecell">${isWarn(it)?`<span class="warn-ic" title="Perlu dicek">${IC.warn}</span>`:''}<input class="in" data-f="name" value="${esc(it.name)}" placeholder="Nama barang"></div></td>
    <td><div class="qty"><input class="in" type="number" min="0" step="any" data-f="qty" value="${it.qty}"><select class="in" data-f="unit">${opts(UNITS,it.unit)}</select></div></td>
    <td><div class="pfx"><span>Rp</span><input class="in" type="number" min="0" step="100" data-f="price" value="${it.price}"></div></td>
    <td><select class="in" data-f="cat">${opts(CATS,it.cat)}</select></td>
    <td><select class="in" data-f="food"><option value="1" ${it.food?'selected':''}>Bahan makanan</option><option value="0" ${it.food?'':'selected'}>Non-makanan (abaikan)</option></select></td>
    <td><input class="in" type="date" data-f="expiry" value="${esc(it.expiry||'')}" ${it.food?'':'disabled'}></td>
    <td class="conf">${confBadge(it)}</td>
    <td><button class="icon-btn" type="button" data-del title="Hapus baris">${IC.trash}</button></td></tr>`;
}
function renderTable(){ $('tbody').innerHTML=state.items.map(rowHTML).join(''); updateSummary(); }
function showResult(){
  $('resultCard').hidden=false;
  $('fStore').value=state.store; $('fDate').value=state.date; $('fTotal').value=state.total||'';
  $('fCat').innerHTML=opts(CATS,state.cat); $('fSplit').checked=state.split;
  const th=$('resThumb'); if(state.thumb){th.src=state.thumb;th.hidden=false}else th.hidden=true;
  renderTable(); updateButtons(); $('doneBox').hidden=!(state.savedStock&&state.savedBudget);
}
const sumItems=()=>state.items.reduce((a,i)=>a+(+i.price||0),0);
function updateSummary(){
  const food=state.items.filter(i=>i.food&&i.name.trim()).length, non=state.items.filter(i=>!i.food).length, warn=state.items.filter(isWarn).length, unk=state.items.filter(isUnknown).length, sum=sumItems();
  $('pills').innerHTML=`<span class="pill g">${food} bahan makanan</span><span class="pill">${non} non-makanan (diabaikan)</span>${warn?`<span class="pill y">${IC.warn}${warn} item perlu dicek</span>`:''}${unk?`<span class="pill b">${unk} jenis belum dikenali</span>`:''}${(!warn&&!unk)?'<span class="pill b">Semua item sudah dicek</span>':''}<span class="pill b">Jumlah item: ${rp(sum)}</span>`;
  const n=$('noteMismatch'), tot=+state.total||0;
  if(tot && Math.abs(tot-sum)>0){ n.hidden=false; n.innerHTML=`${IC.warn}<span>Total struk (${rp(tot)}) berbeda ${rp(Math.abs(tot-sum))} dari jumlah harga item (${rp(sum)}). Bisa karena diskon, pajak, atau ada item yang salah baca. Cek lagi.</span>`; }
  else n.hidden=true;
}
function refreshRow(i){ const tr=$('tbody').querySelector(`tr[data-i="${i}"]`); if(tr) tr.outerHTML=rowHTML(state.items[i],i); }

$('tbody').addEventListener('input',e=>{
  const tr=e.target.closest('tr'); if(!tr) return; const i=+tr.dataset.i, it=state.items[i], f=e.target.dataset.f;
  if(f==='name'||f==='qty'||f==='price'){
    it[f]= f==='name'?e.target.value:(+e.target.value||0);
    if(!it.edited){ it.edited=true; tr.querySelector('.conf').innerHTML=confBadge(it); tr.classList.remove('warn'); const w=tr.querySelector('.warn-ic'); if(w) w.remove(); }
    if(f==='price'&&!state.totalTouched){ state.total=sumItems(); $('fTotal').value=state.total||''; }
  } else if(f==='expiry') it.expiry=e.target.value;
  updateSummary(); if(state.status==='success') renderStatus();
});
$('tbody').addEventListener('change',e=>{
  const tr=e.target.closest('tr'); if(!tr) return; const i=+tr.dataset.i, it=state.items[i], f=e.target.dataset.f;
  if(f==='name'){ if(!it.touched){ enrich(it); it.edited=true; refreshRow(i); } }
  else if(f==='unit'){ it.unit=e.target.value; }
  else if(f==='cat'){ it.cat=e.target.value; it.touched=true; }
  else if(f==='food'){ it.food=e.target.value==='1'; it.touched=true; it.edited=true; if(it.food&&!it.expiry) it.expiry=addDays(14); refreshRow(i); }
  autoCat(); updateSummary();
});
$('tbody').addEventListener('click',e=>{
  const b=e.target.closest('[data-del]'); if(!b) return; const i=+b.closest('tr').dataset.i;
  state.items.splice(i,1); if(!state.items.length) state.items.push(blankItem()); renderTable(); autoCat();
});
$('btnAddRow').onclick=()=>{ state.items.push(blankItem()); renderTable(); const r=$('tbody').lastElementChild; if(r) r.querySelector('[data-f=name]').focus(); };
$('fStore').addEventListener('input',e=>state.store=e.target.value);
$('fDate').addEventListener('input',e=>state.date=e.target.value);
$('fTotal').addEventListener('input',e=>{ state.total=+e.target.value||0; state.totalTouched=true; updateSummary(); });
$('fCat').addEventListener('change',e=>{ state.cat=e.target.value; state.catTouched=true; });
$('fSplit').addEventListener('change',e=>state.split=e.target.checked);

/* ================= SIMPAN ================= */
function updateButtons(){
  const s=$('btnStock'), b=$('btnBudget'), both=$('btnBoth');
  s.disabled=state.savedStock; s.innerHTML=state.savedStock?'✓ Sudah masuk stok':'Simpan ke Stok Dapur';
  b.disabled=state.savedBudget; b.innerHTML=state.savedBudget?'✓ Sudah tercatat':'Catat ke Anggaran';
  both.disabled=state.savedStock&&state.savedBudget;
  if(state.savedStock||state.savedBudget) setStep(4);
}
function validate(){ if(!state.date){toast('Isi tanggal belanja dulu.');return false} return true; }
async function doStock(){
  const rows=state.items.filter(i=>i.food&&i.name.trim());
  if(!rows.length){ toast('Tidak ada bahan makanan untuk disimpan ke stok.'); return false; }
  await API.saveStock(rows.map(i=>({name:i.name.trim(),category:i.cat,location:i.loc||'Rak Kering',quantity:+i.qty||1,unit:i.unit,expiry_date:i.expiry||null,bought_at:state.date,source:'scan-struk'})));
  state.savedStock=true; return rows.length;
}
async function doBudget(){
  const store=(state.store||'Tanpa nama toko').trim(); let txs=[];
  if(state.split){
    const by={}; state.items.forEach(i=>{ const c=i.food?i.cat:'Lainnya'; by[c]=(by[c]||0)+(+i.price||0); });
    txs=Object.keys(by).filter(c=>by[c]>0).map(c=>({date:state.date,store,category:c,amount:by[c],source:'scan-struk'}));
  } else {
    const amt=+state.total>0?+state.total:sumItems();
    if(amt>0) txs=[{date:state.date,store,category:state.cat,amount:amt,source:'scan-struk'}];
  }
  if(!txs.length){ toast('Total belanja masih 0. Isi total atau harga item dulu.'); return false; }
  await API.saveTransactions(txs); state.savedBudget=true; return txs.length;
}
$('btnStock').onclick=async()=>{ if(!validate()) return; const n=await doStock(); if(n){ saveRecord(); afterSave(`${n} bahan masuk ke stok dapur`);} };
$('btnBudget').onclick=async()=>{ if(!validate()) return; const n=await doBudget(); if(n){ saveRecord(); afterSave(n>1?`${n} transaksi dicatat ke anggaran`:'Total belanja dicatat ke anggaran');} };
$('btnBoth').onclick=async()=>{
  if(!validate()) return; let a=0,b=0;
  if(!state.savedStock) a=await doStock(); if(!state.savedBudget) b=await doBudget();
  if(a||b){ saveRecord(); afterSave('Tersimpan ke stok dapur dan anggaran'); }
};
function afterSave(msg){ updateButtons(); $('doneBox').hidden=!(state.savedStock&&state.savedBudget); renderHistory(); toast(msg); }
$('btnNew').onclick=resetAll;
function resetAll(){
  state=freshState(); cancelCrop(); $('resultCard').hidden=true; $('pv').hidden=true; drop.hidden=false;
  setStep(1); renderStatus(); window.scrollTo({top:0,behavior:'smooth'});
}

/* ================= RIWAYAT ================= */
function seedHistory(){
  const mk=(store,off,list,stock,bud)=>{ const items=list.map(l=>{const it=mkItem(l[0],l[1],l[2],100);it.edited=true;return it;});
    return {id:'seed-'+store,store,date:addDays(off),total:items.reduce((a,i)=>a+i.price,0),cat:'Bahan Pokok',items,thumb:'',savedStock:stock,savedBudget:bud,createdAt:Date.now()+off}; };
  return [
    mk('Superindo',-3,[['Brokoli',2,22000],['Dada Ayam Fillet 500g',1,39000],['Telur Ayam 10 Butir',1,28500],['Sabun Cuci Piring',1,14500]],true,true),
    mk('Alfamart',-8,[['Susu UHT 1L',3,55500],['Beras Premium 5kg',1,72000],['Kecap Manis',1,12000]],true,false)
  ];
}
let history = LS.get('pantrify.receipts',null) || seedHistory();
function saveRecord(){
  const rec={id:state.recId||('r'+Date.now()),store:(state.store||'Tanpa nama toko').trim(),date:state.date,total:+state.total>0?+state.total:sumItems(),cat:state.cat,items:state.items,thumb:state.thumb,savedStock:state.savedStock,savedBudget:state.savedBudget,createdAt:Date.now()};
  state.recId=rec.id; const idx=history.findIndex(h=>h.id===rec.id);
  if(idx>=0) history[idx]=rec; else history.unshift(rec);
  LS.set('pantrify.receipts',history);
}
function renderHistory(){
  const h=history.slice().sort((a,b)=>(b.date||'').localeCompare(a.date||'')||b.createdAt-a.createdAt);
  $('hist').innerHTML = h.length ? h.map(r=>`<div class="hrow" data-id="${esc(r.id)}">
    ${r.thumb?`<img class="thumb" src="${r.thumb}" alt="">`:`<div class="thumb" style="display:grid;place-items:center;color:#94a3b8">${IC.img}</div>`}
    <div class="hinfo"><b>${esc(r.store)}</b><span>${fmtDate(r.date)} · ${r.items.length} item</span></div>
    <div class="hchips"><span class="pill ${r.savedStock?'g':''}">${r.savedStock?'✓ Masuk stok':'Belum masuk stok'}</span><span class="pill ${r.savedBudget?'g':''}">${r.savedBudget?'✓ Tercatat anggaran':'Belum dicatat'}</span></div>
    <div class="htotal">${rp(r.total)}</div>
    <div style="display:flex;gap:8px"><button class="btn sm" type="button" data-view>Lihat</button><button class="icon-btn" type="button" data-rm title="Hapus">${IC.trash}</button></div></div>`).join('')
    : '<div class="empty">Belum ada struk yang di-scan.</div>';
}
$('hist').addEventListener('click',e=>{
  const row=e.target.closest('.hrow'); if(!row) return; const r=history.find(x=>x.id===row.dataset.id); if(!r) return;
  if(e.target.closest('[data-view]')){
    state=freshState(); state.store=r.store; state.date=r.date; state.total=r.total; state.totalTouched=true; state.cat=r.cat; state.catTouched=true;
    state.items=JSON.parse(JSON.stringify(r.items)); state.thumb=r.thumb||''; state.recId=r.id; state.savedStock=r.savedStock; state.savedBudget=r.savedBudget; state.status='success';
    $('pv').hidden=true; drop.hidden=false; renderStatus(); setStep(3); showResult(); $('resultCard').scrollIntoView({behavior:'smooth'});
  }
  if(e.target.closest('[data-rm]') && confirm('Hapus struk ini dari riwayat? (Stok dan anggaran yang sudah tercatat tidak ikut terhapus)')){
    history=history.filter(x=>x.id!==r.id); LS.set('pantrify.receipts',history); renderHistory(); toast('Struk dihapus dari riwayat');
  }
});

/* ================= INIT ================= */
setStep(1); renderStatus(); renderHistory();
})();
@endverbatim
</script>
@endsection