<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{ url('home') }}" id="dashboard" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li>
                    <a id="keanggotaan" href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i> <span>Keanggotaan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse">
                        <ul class="nav">
                            <li><a id="listMember" href="{{ url('member') }}" class="">Daftar Anggota</a></li>
                            <li><a id="addMember" href="{{ url('member/create') }}" class="">Tambah Anggota</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a id="transaction" href="#subPages-transaction" data-toggle="collapse" class="collapsed"><i class="lnr lnr-apartment"></i> <span>Transaksi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages-transaction" class="collapse">
                        <ul class="nav">
                            <li><a id="transaction-save" href="{{ route('saving.index') }}">Simpan</a></li>
                            <li><a id="transaction-loan" href="{{ route('loan.index') }}">Pinjam</a></li>
                            <li><a id="transaction-withdraw" href="{{ route('withdraw.index') }}">Withdraw</a></li>
                            <li><a id="transaction-installment-payment" href="{{ route('installment-payment.index') }}">Angsuran</a></li>
                            <li><a id="transaction-installment-payment" href="{{ route('sales.index') }}">Penjualan</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="{{ url('profitsharing') }}"><i class="lnr lnr-file-empty"></i> <span>Bagi Hasil</span></a></li>
                <li>
                    <a href="#subPages-report" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Report</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages-report" class="collapse">
                        <ul class="nav">
                            <li><a id="transaction-save" href="{{ route('report.simpanan') }}">Simpan</a></li>
                            <li><a id="transaction-loan" href="{{ route('report.pinjaman') }}">Pinjam</a></li>
                            <li><a id="transaction-withdraw" href="{{ route('report.withdraw') }}">Withdraw</a></li>
                            <li><a id="transaction-installment-payment" href="{{ route('report.angsuran') }}">Angsuran</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages-produk" data-toggle="collapse" class="collapsed"><i class="lnr lnr-apartment"></i> <span>Produk & Barang</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages-produk" class="collapse">
                        <ul class="nav">
                            <li><a href="{{ route('product.index') }}" class="">Daftar Barang</a></li>
                            <li><a href="{{ route('product.create') }}" class="">Tambah Barang</a></li>
                            <li><a href="{{ route('category.index') }}" class="">Kategori</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="{{ route('store.index') }}"><i class="lnr lnr-exit"></i> <span>Go to STORE</span></a></li>
            </ul>
        </nav>
    </div>
</div>

