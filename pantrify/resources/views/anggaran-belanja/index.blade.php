@extends('layouts.app')

@section('title', 'Anggaran Belanja')

@section('content')
<style>
@verbatim
.ag{
  --bg:#fdf7f7; --card:#fff; --ink:#0f172a; --muted:#64748b; --line:#eef0f3;
  --navy:#0f172a; --green:#16a34a; --green-soft:#dcfce7;
  --yellow:#eab308; --yellow-soft:#fef9c3; --red:#ef4444; --red-soft:#fee2e2;
  --radius:20px;
}
.ag *{box-sizing:border-box}
.ag{font-family:'Plus Jakarta Sans',system-ui,sans-serif;color:var(--ink);font-size:14px}
.ag button,.ag input,.ag select{font:inherit;color:inherit}
.ag button{cursor:pointer}
.ag svg{display:block}
.ag .icon{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.ag{min-width:0;padding-bottom:40px}
.ag .page-head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;margin-bottom:24px;flex-wrap:wrap}
.ag h1{font-size:26px;font-weight:800;letter-spacing:-.4px}
.ag .sub{color:#475569;margin-top:6px;font-size:15px}
.ag .head-actions{display:flex;gap:10px}
.ag .btn{display:inline-flex;align-items:center;gap:8px;border-radius:999px;padding:12px 22px;font-weight:700;border:1px solid var(--line);background:#fff}
.ag .btn:hover{background:#f6f7f9}
.ag .btn.primary{background:var(--navy);color:#fff;border-color:var(--navy)}
.ag .btn.primary:hover{background:#1e293b}
.ag .btn.green{background:var(--green);color:#fff;border-color:var(--green)}
.ag .btn.sm{padding:8px 14px;font-size:13px}
.ag .card{background:var(--card);border:1px solid var(--line);border-radius:var(--radius);padding:24px}
.ag .card h2{font-size:16px;font-weight:700}
.ag .card .hint{color:#64748b;font-size:13px;margin-top:4px}
.ag .alert{display:none;background:var(--navy);color:#fff;border-radius:var(--radius);padding:24px 28px;margin-bottom:20px;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap}
.ag .alert.show{display:flex}
.ag .alert h3{font-size:20px;font-weight:800;display:flex;align-items:center;gap:10px;color:#fff}
.ag .alert p{color:#e2e8f0;margin-top:8px;font-size:15px;line-height:1.5}
.ag .alert.danger{background:#7f1d1d}
.ag .alert.danger p{color:#ffe4e6}
.ag .overview{margin-bottom:20px}
.ag .ov-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;gap:12px;flex-wrap:wrap}
.ag .ov-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:22px}
.ag .ov-item small{color:#475569;display:block;margin-bottom:6px;font-size:13.5px;font-weight:500}
.ag .ov-item strong{font-size:26px;font-weight:800;letter-spacing:-.5px}
.ag .ov-item.rest strong{color:var(--green)}
.ag .ov-item.rest.warn strong{color:#ca8a04}
.ag .ov-item.rest.bad strong{color:var(--red)}
.ag .bar-wrap{height:16px;background:#f1f5f9;border-radius:999px;overflow:hidden}
.ag .bar{height:100%;width:0;border-radius:999px;background:var(--green);transition:width .6s ease,background .3s}
.ag .bar.warn{background:var(--yellow)}
.ag .bar.bad{background:var(--red)}
.ag .bar-meta{display:flex;justify-content:space-between;margin-top:10px;font-size:13.5px;color:#475569;flex-wrap:wrap;gap:6px}
.ag .bar-meta b{color:var(--ink)}
.ag .legend-inline{display:flex;gap:14px}
.ag .legend-inline i{display:inline-block;width:9px;height:9px;border-radius:50%;margin-right:5px}
.ag .stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:20px}
.ag .stat{display:flex;gap:16px;align-items:center;padding:20px}
.ag .stat .ic{width:44px;height:44px;border-radius:12px;display:grid;place-items:center;flex:none}
.ag .stat small{color:#475569;display:block;font-size:13.5px;font-weight:500}
.ag .stat strong{font-size:22px;font-weight:800;display:block;margin-top:2px}
.ag .stat em{font-style:normal;font-size:13px;color:#64748b;display:block;margin-top:4px}
.ag .ic.g{background:var(--green-soft);color:var(--green)}
.ag .ic.y{background:var(--yellow-soft);color:#a16207}
.ag .ic.r{background:var(--red-soft);color:var(--red)}
.ag .tag{display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:700;padding:3px 10px;border-radius:999px}
.ag .tag.up{background:var(--red-soft);color:#b91c1c}
.ag .tag.down{background:var(--green-soft);color:#15803d}
.ag .tag.same{background:#f1f5f9;color:var(--muted)}
.ag .row2{display:grid;grid-template-columns:1fr 1.3fr;gap:16px;margin-bottom:20px}
.ag .donut-wrap{display:flex;align-items:center;gap:24px;margin-top:18px;flex-wrap:wrap}
.ag .donut{width:190px;height:190px;flex:none;position:relative}
.ag .donut .center{position:absolute;inset:0;display:grid;place-content:center;text-align:center}
.ag .donut .center b{font-size:17px;font-weight:800}
.ag .donut .center span{font-size:11.5px;color:var(--muted)}
.ag .legend{flex:1;min-width:170px;display:flex;flex-direction:column;gap:9px}
.ag .legend div{display:flex;align-items:center;gap:8px;font-size:13px}
.ag .legend i{width:10px;height:10px;border-radius:50%;flex:none}
.ag .legend span{margin-left:auto;font-weight:700}
.ag .legend small{color:var(--muted);width:38px;text-align:right}
.ag #barChart{margin-top:14px;width:100%;height:230px}
.ag #barChart text{font-family:inherit;font-size:11px;fill:var(--muted)}
.ag #barChart .bar-rect{fill:var(--navy);transition:fill .2s}
.ag #barChart .bar-rect:hover{fill:var(--green)}
.ag .cat-list{display:grid;grid-template-columns:repeat(2,1fr);gap:18px 32px;margin-top:20px}
.ag .cat-item .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;gap:8px}
.ag .cat-item .name{display:flex;align-items:center;gap:8px;font-weight:600}
.ag .cat-item .name i{width:10px;height:10px;border-radius:50%}
.ag .cat-item .amt{font-size:12.5px;color:var(--muted)}
.ag .cat-item .amt b{color:var(--ink)}
.ag .cat-item .bar-wrap{height:9px}
.ag .cat-item .foot{display:flex;justify-content:space-between;font-size:12px;color:var(--muted);margin-top:6px}
.ag .search{display:flex;align-items:center;gap:10px;background:#f8fafc;border:1px solid var(--line);border-radius:999px;padding:0 18px;height:46px;margin:18px 0 16px}
.ag .search input{border:0;background:none;outline:0;flex:1;height:100%}
.ag .search .icon{color:var(--muted)}
.ag .filters{display:flex;gap:16px 24px;flex-wrap:wrap;align-items:center;margin-bottom:8px}
.ag .f-group{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.ag .f-group label{color:var(--muted);font-size:12.5px;font-weight:600;min-width:56px}
.ag .chip{border:1px solid var(--line);background:#fff;border-radius:999px;padding:7px 15px;font-size:13px;color:var(--muted)}
.ag .chip:hover{background:#f6f7f9}
.ag .chip.active{background:var(--navy);border-color:var(--navy);color:#fff;font-weight:600}
.ag .field{border:1px solid var(--line);background:#fff;border-radius:12px;padding:8px 12px;outline:0}
.ag .field:focus{border-color:var(--navy)}
.ag .table-wrap{overflow-x:auto;margin-top:14px}
.ag table{width:100%;border-collapse:collapse;min-width:640px}
.ag th{text-align:left;color:var(--muted);font-weight:500;font-size:12.5px;padding:14px 12px;border-bottom:1px solid var(--line)}
.ag td{padding:16px 12px;border-bottom:1px solid var(--line);font-size:13.5px}
.ag td.store{font-weight:700}
.ag td.num,.ag th.num{text-align:right}
.ag td.num{font-weight:700}
.ag tbody tr:hover{background:#fafbfc}
.ag .cat-pill{display:inline-block;padding:4px 11px;border-radius:999px;font-size:12px;font-weight:500}
.ag .icon-btn{width:34px;height:34px;border-radius:10px;border:1px solid var(--line);background:#fff;display:inline-grid;place-items:center;color:var(--muted)}
.ag .icon-btn:hover{color:var(--red);background:var(--red-soft)}
.ag .table-foot{display:flex;justify-content:space-between;margin-top:14px;color:var(--muted);font-size:13px;flex-wrap:wrap;gap:8px}
.ag .table-foot b{color:var(--ink)}
.ag .empty{text-align:center;color:var(--muted);padding:40px 0;display:none}
.ag .overlay{position:fixed;inset:0;background:rgba(15,23,42,.5);display:none;place-items:center;padding:20px;z-index:50}
.ag .overlay.show{display:grid}
.ag .modal{background:#fff;border-radius:24px;padding:28px;width:100%;max-width:440px;max-height:92vh;overflow:auto}
.ag .modal h3{font-size:19px;font-weight:800}
.ag .modal p.sub{margin-bottom:18px}
.ag .form-row{margin-bottom:14px}
.ag .form-row label{display:block;font-size:12.5px;font-weight:600;color:var(--muted);margin-bottom:6px}
.ag .form-row .field{width:100%;padding:12px 14px}
.ag .prefix{position:relative}
.ag .prefix span{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--muted);font-weight:600}
.ag .prefix .field{padding-left:42px}
.ag .modal-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:20px}
.ag .grid2{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.ag .divider{font-size:12px;font-weight:700;color:var(--muted);margin:18px 0 10px;text-transform:uppercase;letter-spacing:.5px}
.ag .toast{position:fixed;bottom:24px;left:50%;transform:translate(-50%,80px);background:var(--navy);color:#fff;padding:12px 22px;border-radius:999px;font-weight:600;transition:transform .3s;z-index:60}
.ag .toast.show{transform:translate(-50%,0)}
@media (max-width:1100px){.ag .row2{grid-template-columns:1fr}
}
@media (max-width:860px){.ag .ov-grid,.ag .stats,.ag .cat-list{grid-template-columns:1fr}
}
@endverbatim
</style>

<div class="ag">

    <div class="page-head">
      <div>
        <h1>Anggaran</h1>
        <p class="sub" id="periodLabel">Pantau pengeluaran belanja dapurmu bulan ini.</p>
      </div>
      <div class="head-actions">
        <button class="btn" id="btnBudget">Atur Anggaran</button>
        <button class="btn primary" id="btnAdd"><svg class="icon" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>Tambah Transaksi</button>
      </div>
    </div>

    <!-- Peringatan 80% -->
    <section class="alert" id="alertBox">
      <div>
        <h3><svg class="icon" viewBox="0 0 24 24" style="width:22px;height:22px"><path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/><path d="M12 9v4M12 17h.01"/></svg><span id="alertTitle"></span></h3>
        <p id="alertText"></p>
      </div>
      <button class="btn green" id="btnToHistory">Lihat riwayat transaksi</button>
    </section>

    <!-- Ringkasan anggaran -->
    <section class="card overview">
      <div class="ov-top">
        <div><h2>Ringkasan Bulan Ini, <span id="ovMonth"></span></h2><p class="hint">Sisa anggaran berubah warna saat mendekati batas</p></div>
        <div class="legend-inline hint">
          <span><i style="background:var(--green)"></i>&lt; 60%</span>
          <span><i style="background:var(--yellow)"></i>60–79%</span>
          <span><i style="background:var(--red)"></i>≥ 80%</span>
        </div>
      </div>
      <div class="ov-grid">
        <div class="ov-item"><small>Total anggaran bulanan</small><strong id="ovBudget">-</strong></div>
        <div class="ov-item"><small>Total terpakai</small><strong id="ovSpent">-</strong></div>
        <div class="ov-item rest" id="ovRestBox"><small>Sisa anggaran</small><strong id="ovRest">-</strong></div>
      </div>
      <div class="bar-wrap"><div class="bar" id="mainBar"></div></div>
      <div class="bar-meta"><span><b id="pctUsed">0%</b> anggaran terpakai</span><span id="pctLeft"></span></div>
    </section>

    <!-- Statistik -->
    <section class="stats">
      <div class="card stat">
        <div class="ic y"><svg class="icon" viewBox="0 0 24 24"><path d="M3 3v18h18"/><path d="m7 15 4-4 3 3 5-6"/></svg></div>
        <div><small>Rata-rata pengeluaran / hari</small><strong id="stAvg">-</strong><em id="stAvgNote"></em></div>
      </div>
      <div class="card stat">
        <div class="ic g"><svg class="icon" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><circle cx="12" cy="12" r="3"/></svg></div>
        <div><small>Bisa belanja / hari</small><strong id="stDaily">-</strong><em id="stDailyNote"></em></div>
      </div>
      <div class="card stat">
        <div class="ic r" id="stCmpIc"><svg class="icon" viewBox="0 0 24 24"><path d="M7 17 17 7M7 7h10v10"/></svg></div>
        <div><small>Dibanding bulan lalu</small><strong id="stCmp">-</strong><em id="stCmpNote"></em></div>
      </div>
    </section>

    <!-- Grafik -->
    <section class="row2">
      <div class="card">
        <h2>Pengeluaran per kategori</h2>
        <p class="hint">Porsi tiap kategori dari total terpakai</p>
        <div class="donut-wrap">
          <div class="donut"><svg viewBox="0 0 200 200" id="donutSvg"></svg><div class="center"><b id="donutTotal">-</b><span>total</span></div></div>
          <div class="legend" id="legend"></div>
        </div>
      </div>
      <div class="card">
        <h2>Pengeluaran per minggu</h2>
        <p class="hint">Total belanja tiap minggu di bulan ini</p>
        <svg id="barChart" viewBox="0 0 560 230" preserveAspectRatio="xMidYMid meet"></svg>
      </div>
    </section>

    <!-- Anggaran per kategori -->
    <section class="card" style="margin-bottom:20px">
      <h2>Anggaran per kategori</h2>
      <p class="hint">Batas belanja tiap kategori (opsional) dan perbandingannya dengan bulan lalu</p>
      <div class="cat-list" id="catList"></div>
    </section>

    <!-- Riwayat transaksi -->
    <section class="card" id="historyCard">
      <h2>Riwayat transaksi</h2>
      <div class="search">
        <svg class="icon" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
        <input id="fSearch" type="text" placeholder="Cari toko atau kategori…">
      </div>
      <div class="filters">
        <div class="f-group"><label>Kategori</label><span id="catChips" class="f-group"></span></div>
      </div>
      <div class="filters" style="margin-top:12px">
        <div class="f-group"><label>Toko</label>
          <select class="field" id="fStore"><option value="">Semua toko</option></select></div>
        <div class="f-group"><label>Tanggal</label>
          <input type="date" class="field" id="fFrom"> <span style="color:var(--muted)">s/d</span> <input type="date" class="field" id="fTo"></div>
        <button class="btn sm" id="fReset">Reset filter</button>
      </div>

      <div class="table-wrap">
        <table>
          <thead><tr><th>Tanggal</th><th>Toko</th><th>Kategori</th><th class="num">Nominal</th><th class="num">Aksi</th></tr></thead>
          <tbody id="tbody"></tbody>
        </table>
        <div class="empty" id="empty">Tidak ada transaksi yang cocok dengan filter.</div>
      </div>
      <div class="table-foot"><span id="countInfo"></span><span>Total hasil filter: <b id="sumInfo">Rp 0</b></span></div>
    </section>
  <!-- Modal tambah transaksi -->
<div class="overlay" id="modalTx">
  <form class="modal" id="formTx">
    <h3>Tambah Transaksi</h3>
    <p class="sub">Catat belanja tanpa struk, misalnya di pasar tradisional.</p>
    <div class="form-row"><label>Tanggal</label><input type="date" class="field" id="txDate" required></div>
    <div class="form-row"><label>Toko / Tempat belanja</label><input class="field" id="txStore" list="storeList" placeholder="mis. Pasar Tradisional" required><datalist id="storeList"></datalist></div>
    <div class="form-row"><label>Kategori</label><select class="field" id="txCat" required></select></div>
    <div class="form-row"><label>Nominal</label><div class="prefix"><span>Rp</span><input type="number" min="1" step="500" class="field" id="txAmount" placeholder="0" required></div></div>
    <div class="modal-actions"><button type="button" class="btn" data-close>Batal</button><button class="btn primary" type="submit">Simpan</button></div>
  </form>
</div>

<!-- Modal atur anggaran -->
<div class="overlay" id="modalBudget">
  <form class="modal" id="formBudget">
    <h3>Atur Anggaran</h3>
    <p class="sub">Tentukan anggaran bulanan dan (opsional) batas per kategori.</p>
    <div class="form-row"><label>Total anggaran bulanan</label><div class="prefix"><span>Rp</span><input type="number" min="1" step="10000" class="field" id="bTotal" required></div></div>
    <div class="divider">Per kategori (opsional)</div>
    <div id="bCats"></div>
    <div class="modal-actions"><button type="button" class="btn" data-close>Batal</button><button class="btn primary" type="submit">Simpan</button></div>
  </form>
</div>

<div class="toast" id="toast"></div>
</div>

<script>
@verbatim
(function(){

/* ================= DATA ================= */
const CATS = {
  'Sayuran':       {color:'#22c55e', bg:'#dcfce7', fg:'#166534'},
  'Buah':          {color:'#f97316', bg:'#ffedd5', fg:'#9a3412'},
  'Daging & Ikan': {color:'#ef4444', bg:'#fee2e2', fg:'#991b1b'},
  'Telur & Susu':  {color:'#3b82f6', bg:'#dbeafe', fg:'#1e40af'},
  'Bumbu':         {color:'#a855f7', bg:'#f3e8ff', fg:'#6b21a8'},
  'Bahan Pokok':   {color:'#eab308', bg:'#fef9c3', fg:'#854d0e'},
  'Lainnya':       {color:'#64748b', bg:'#f1f5f9', fg:'#334155'}
};
const CAT_NAMES = Object.keys(CATS);

const NOW   = new Date();
const YEAR  = NOW.getFullYear(), MONTH = NOW.getMonth();
const TODAY = NOW.getDate();
const DAYS_IN_MONTH = new Date(YEAR, MONTH + 1, 0).getDate();
const DAYS_LEFT = DAYS_IN_MONTH - TODAY + 1; // termasuk hari ini

let state = {
  budget: 3200000,
  catBudget: {'Sayuran':400000,'Buah':200000,'Daging & Ikan':800000,'Telur & Susu':350000,'Bumbu':150000,'Bahan Pokok':650000,'Lainnya':200000},
  lastMonth: {'Sayuran':360000,'Buah':190000,'Daging & Ikan':780000,'Telur & Susu':310000,'Bumbu':140000,'Bahan Pokok':540000,'Lainnya':120000},
  tx: [],
  nextId: 1
};

// Data contoh (hari disesuaikan dengan bulan berjalan)
[[1,'Pasar Tradisional Kebon','Sayuran',85000],[2,'Superindo','Bahan Pokok',342000],[3,'Alfamart','Telur & Susu',96500],
 [4,'Pasar Tradisional Kebon','Daging & Ikan',185000],[6,'Transmart','Bumbu',64000],[7,'Hypermart','Buah',112000],
 [9,'Superindo','Daging & Ikan',238000],[10,'Pasar Tradisional Kebon','Sayuran',72000],[12,'Alfamart','Lainnya',58500],
 [13,'Indomaret','Telur & Susu',124000],[15,'Superindo','Bahan Pokok',276000],[16,'Pasar Tradisional Kebon','Daging & Ikan',164000],
 [18,'Hypermart','Buah',98000],[19,'Transmart','Sayuran',91000],[21,'Alfamart','Bumbu',47500],
 [22,'Superindo','Daging & Ikan',221000],[24,'Pasar Tradisional Kebon','Sayuran',68000],[25,'Indomaret','Telur & Susu',79500],
 [26,'Transmart','Bahan Pokok',198000],[27,'Pasar Tradisional Kebon','Daging & Ikan',133000]
].forEach(([d,store,cat,amount])=>{
  state.tx.push({id:state.nextId++, date:iso(YEAR,MONTH,Math.min(d,TODAY)), store, cat, amount});
});

/* ================= HELPERS ================= */
function iso(y,m,d){return `${y}-${String(m+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`}
const rp = n => 'Rp ' + Math.round(n).toLocaleString('id-ID');
const esc = s => String(s).replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
const $ = id => document.getElementById(id);
const fmtDate = s => { const [y,m,d]=s.split('-').map(Number); return new Date(y,m-1,d).toLocaleDateString('id-ID',{day:'numeric',month:'short',year:'numeric'}); };
const monthTx = () => state.tx.filter(t => t.date.startsWith(`${YEAR}-${String(MONTH+1).padStart(2,'0')}`));
function toast(msg){const t=$('toast');t.textContent=msg;t.classList.add('show');setTimeout(()=>t.classList.remove('show'),2200)}

/* ================= RENDER: RINGKASAN ================= */
function render(){
  const txs = monthTx();
  const spent = txs.reduce((a,t)=>a+t.amount,0);
  const rest = state.budget - spent;
  const pct = state.budget ? spent/state.budget*100 : 0;
  const level = pct>=80 ? 'bad' : pct>=60 ? 'warn' : '';

  $('ovMonth').textContent = new Date(YEAR,MONTH,1).toLocaleDateString('id-ID',{month:'long'});
  $('periodLabel').textContent = `Pantau pengeluaran belanja dapurmu — ${new Date(YEAR,MONTH,1).toLocaleDateString('id-ID',{month:'long',year:'numeric'})}.`;
  $('ovBudget').textContent = rp(state.budget);
  $('ovSpent').textContent  = rp(spent);
  $('ovRest').textContent   = rest>=0 ? rp(rest) : '-' + rp(-rest);
  $('ovRestBox').className  = 'ov-item rest ' + level;
  const bar = $('mainBar'); bar.className = 'bar ' + level; bar.style.width = Math.min(pct,100)+'%';
  $('pctUsed').textContent = pct.toFixed(1).replace('.',',') + '%';
  $('pctLeft').textContent = rest>=0 ? `Sisa ${Math.max(0,100-pct).toFixed(1).replace('.',',')}% dari anggaran` : `Melebihi anggaran ${rp(-rest)}`;

  // Peringatan 80%
  const box = $('alertBox');
  if(pct>=80){
    box.classList.add('show'); box.classList.toggle('danger', pct>=100);
    $('alertTitle').textContent = pct>=100 ? 'Anggaran sudah terlampaui!' : 'Anggaran hampir habis';
    $('alertText').textContent = pct>=100
      ? `Pengeluaranmu sudah ${rp(-rest)} di atas batas anggaran bulan ini.`
      : `Pengeluaran sudah mencapai ${Math.round(pct)}% dari anggaran. Sisa ${rp(rest)} untuk ${DAYS_LEFT} hari ke depan.`;
  } else box.classList.remove('show');

  // Rata-rata & estimasi per hari
  const avg = spent / TODAY;
  $('stAvg').textContent = rp(avg);
  $('stAvgNote').textContent = `selama ${TODAY} hari berjalan`;
  const daily = rest>0 ? rest/DAYS_LEFT : 0;
  $('stDaily').textContent = rp(daily);
  $('stDailyNote').textContent = rest>0 ? `sampai akhir bulan (${DAYS_LEFT} hari lagi)` : 'anggaran sudah habis';
  $('stDaily').parentElement.previousElementSibling.className = 'ic ' + (rest<=0?'r':daily<avg?'y':'g');

  // Perbandingan bulan lalu
  const last = Object.values(state.lastMonth).reduce((a,b)=>a+b,0);
  const diff = spent - last, dp = last? diff/last*100 : 0;
  const cmp = $('stCmp');
  cmp.innerHTML = `${diff>0?'+':diff<0?'−':''}${rp(Math.abs(diff))}`;
  $('stCmpNote').innerHTML = `<span class="tag ${diff>0?'up':diff<0?'down':'same'}">${diff>0?'▲':diff<0?'▼':'•'} ${Math.abs(dp).toFixed(1).replace('.',',')}%</span> &nbsp;bulan lalu ${rp(last)}`;
  $('stCmpIc').className = 'ic ' + (diff>0?'r':'g');

  renderDonut(txs, spent);
  renderBars(txs);
  renderCats(txs);
  renderFilters();
  renderTable();
}

/* ================= DONUT ================= */
function sumByCat(txs){const o={};CAT_NAMES.forEach(c=>o[c]=0);txs.forEach(t=>o[t.cat]+=t.amount);return o}
function renderDonut(txs, total){
  const by = sumByCat(txs), r=70, C=2*Math.PI*r;
  let off=0, html=`<circle cx="100" cy="100" r="${r}" fill="none" stroke="#f1f5f9" stroke-width="28"/>`;
  CAT_NAMES.forEach(c=>{
    if(!by[c]) return;
    const len = by[c]/total*C;
    html += `<circle cx="100" cy="100" r="${r}" fill="none" stroke="${CATS[c].color}" stroke-width="28"
      stroke-dasharray="${len} ${C-len}" stroke-dashoffset="${-off}" transform="rotate(-90 100 100)"><title>${esc(c)}: ${rp(by[c])}</title></circle>`;
    off += len;
  });
  $('donutSvg').innerHTML = html;
  $('donutTotal').textContent = rp(total);
  $('legend').innerHTML = CAT_NAMES.filter(c=>by[c]).sort((a,b)=>by[b]-by[a]).map(c=>
    `<div><i style="background:${CATS[c].color}"></i>${esc(c)}<span>${rp(by[c])}</span><small>${(by[c]/total*100).toFixed(0)}%</small></div>`).join('') || '<div>Belum ada data</div>';
}

/* ================= BAR MINGGUAN ================= */
function renderBars(txs){
  const weeks = Math.ceil(DAYS_IN_MONTH/7), vals = Array(weeks).fill(0);
  txs.forEach(t=>{ const d=+t.date.slice(8,10); vals[Math.min(Math.floor((d-1)/7),weeks-1)] += t.amount; });
  const W=560,H=230,pl=56,pb=28,pt=16,pr=8;
  const max = Math.max(...vals,1);
  const nice = Math.ceil(max/250000)*250000 || 250000;
  const cw = (W-pl-pr)/weeks, bw = Math.min(54,cw*0.55);
  let s='';
  for(let i=0;i<=4;i++){
    const y = pt + (H-pt-pb)*(1-i/4), v = nice*i/4;
    s += `<line x1="${pl}" x2="${W-pr}" y1="${y}" y2="${y}" stroke="#eef0f3"/><text x="${pl-8}" y="${y+4}" text-anchor="end">${v>=1e6?(v/1e6).toFixed(2).replace(/\.?0+$/,'')+'jt':Math.round(v/1000)+'rb'}</text>`;
  }
  vals.forEach((v,i)=>{
    const h=(H-pt-pb)*v/nice, x=pl+cw*i+(cw-bw)/2, y=H-pb-h;
    const a=i*7+1, b=Math.min((i+1)*7,DAYS_IN_MONTH);
    s += `<rect class="bar-rect" x="${x}" y="${y}" width="${bw}" height="${Math.max(h,0)}" rx="8"><title>Minggu ${i+1} (${a}–${b}): ${rp(v)}</title></rect>`;
    if(v) s += `<text x="${x+bw/2}" y="${y-6}" text-anchor="middle" style="fill:var(--ink);font-weight:700">${Math.round(v/1000)}rb</text>`;
    s += `<text x="${x+bw/2}" y="${H-8}" text-anchor="middle">Mgg ${i+1}</text>`;
  });
  $('barChart').innerHTML = s;
}

/* ================= ANGGARAN PER KATEGORI ================= */
function renderCats(txs){
  const by = sumByCat(txs);
  $('catList').innerHTML = CAT_NAMES.map(c=>{
    const lim = state.catBudget[c]||0, used = by[c], p = lim? used/lim*100 : 0;
    const lvl = !lim ? '' : p>=80?'bad':p>=60?'warn':'';
    const d = used - (state.lastMonth[c]||0);
    return `<div class="cat-item">
      <div class="top"><span class="name"><i style="background:${CATS[c].color}"></i>${esc(c)}</span>
        <span class="amt"><b>${rp(used)}</b>${lim?' / '+rp(lim):' · tanpa batas'}</span></div>
      <div class="bar-wrap"><div class="bar ${lvl}" style="width:${Math.min(p,100)}%"></div></div>
      <div class="foot"><span>${lim?(p>=100?'Melebihi '+rp(used-lim):'Sisa '+rp(lim-used)):'Belum diatur'}</span>
        <span>${d>0?'▲':d<0?'▼':'•'} ${rp(Math.abs(d))} vs bulan lalu</span></div></div>`;
  }).join('');
}

/* ================= FILTER & TABEL ================= */
let filter = {q:'', cat:'Semua', store:'', from:'', to:''};
function renderFilters(){
  $('catChips').innerHTML = ['Semua',...CAT_NAMES].map(c=>`<button type="button" class="chip ${filter.cat===c?'active':''}" data-cat="${esc(c)}">${esc(c)}</button>`).join('');
  const stores=[...new Set(state.tx.map(t=>t.store))].sort();
  $('fStore').innerHTML = '<option value="">Semua toko</option>'+stores.map(s=>`<option ${filter.store===s?'selected':''}>${esc(s)}</option>`).join('');
  $('storeList').innerHTML = stores.map(s=>`<option value="${esc(s)}">`).join('');
}
function filtered(){
  const q=filter.q.trim().toLowerCase();
  return state.tx.filter(t=>
    (filter.cat==='Semua'||t.cat===filter.cat) &&
    (!filter.store||t.store===filter.store) &&
    (!filter.from||t.date>=filter.from) && (!filter.to||t.date<=filter.to) &&
    (!q || t.store.toLowerCase().includes(q) || t.cat.toLowerCase().includes(q) || String(t.amount).includes(q))
  ).sort((a,b)=>b.date.localeCompare(a.date)||b.id-a.id);
}
function renderTable(){
  const rows=filtered();
  $('tbody').innerHTML = rows.map(t=>`<tr>
    <td>${fmtDate(t.date)}</td><td class="store">${esc(t.store)}</td>
    <td><span class="cat-pill" style="background:${CATS[t.cat].bg};color:${CATS[t.cat].fg}">${esc(t.cat)}</span></td>
    <td class="num">${rp(t.amount)}</td>
    <td class="num"><button class="icon-btn" title="Hapus" data-del="${t.id}"><svg class="icon" viewBox="0 0 24 24" style="width:16px;height:16px"><path d="M3 6h18M8 6V4h8v2M6 6l1 14h10l1-14"/></svg></button></td></tr>`).join('');
  $('empty').style.display = rows.length?'none':'block';
  $('countInfo').textContent = `Menampilkan ${rows.length} dari ${state.tx.length} transaksi`;
  $('sumInfo').textContent = rp(rows.reduce((a,t)=>a+t.amount,0));
}

/* ================= EVENTS ================= */
$('catChips').addEventListener('click',e=>{const b=e.target.closest('[data-cat]');if(!b)return;filter.cat=b.dataset.cat;renderFilters();renderTable()});
$('fSearch').addEventListener('input',e=>{filter.q=e.target.value;renderTable()});
$('fStore').addEventListener('change',e=>{filter.store=e.target.value;renderTable()});
$('fFrom').addEventListener('change',e=>{filter.from=e.target.value;renderTable()});
$('fTo').addEventListener('change',e=>{filter.to=e.target.value;renderTable()});
$('fReset').addEventListener('click',()=>{filter={q:'',cat:'Semua',store:'',from:'',to:''};$('fSearch').value='';$('fFrom').value='';$('fTo').value='';renderFilters();renderTable()});
$('tbody').addEventListener('click',e=>{const b=e.target.closest('[data-del]');if(!b)return;
  if(confirm('Hapus transaksi ini?')){state.tx=state.tx.filter(t=>t.id!==+b.dataset.del);render();toast('Transaksi dihapus')}});
$('btnToHistory').addEventListener('click',()=>$('historyCard').scrollIntoView({behavior:'smooth'}));

// Modal
const open = id=>$(id).classList.add('show'), close = id=>$(id).classList.remove('show');
document.querySelectorAll('.overlay').forEach(o=>{
  o.addEventListener('click',e=>{if(e.target===o||e.target.hasAttribute('data-close'))o.classList.remove('show')});
});
document.addEventListener('keydown',e=>{if(e.key==='Escape')document.querySelectorAll('.overlay').forEach(o=>o.classList.remove('show'))});

$('txCat').innerHTML = CAT_NAMES.map(c=>`<option>${esc(c)}</option>`).join('');
$('btnAdd').addEventListener('click',()=>{
  $('formTx').reset(); $('txDate').value = iso(YEAR,MONTH,TODAY);
  open('modalTx'); $('txStore').focus();
});
$('formTx').addEventListener('submit',e=>{
  e.preventDefault();
  state.tx.push({id:state.nextId++, date:$('txDate').value, store:$('txStore').value.trim(), cat:$('txCat').value, amount:+$('txAmount').value});
  close('modalTx'); render(); toast('Transaksi ditambahkan');
});

// Atur anggaran
$('btnBudget').addEventListener('click',()=>{
  $('bTotal').value = state.budget;
  $('bCats').innerHTML = `<div class="grid2">` + CAT_NAMES.map(c=>
    `<div class="form-row"><label>${esc(c)}</label><div class="prefix"><span>Rp</span><input type="number" min="0" step="10000" class="field" data-bcat="${esc(c)}" value="${state.catBudget[c]||''}" placeholder="0"></div></div>`).join('') + `</div>`;
  open('modalBudget');
});
$('formBudget').addEventListener('submit',e=>{
  e.preventDefault();
  state.budget = +$('bTotal').value;
  document.querySelectorAll('[data-bcat]').forEach(i=>state.catBudget[i.dataset.bcat]=+i.value||0);
  close('modalBudget'); render(); toast('Anggaran diperbarui');
});

render();

})();
@endverbatim
</script>
@endsection