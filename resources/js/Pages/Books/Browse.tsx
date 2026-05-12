import React from 'react';
import NgawiLayout from '@/Layouts/NgawiLayout';
import { Head, Link, router } from '@inertiajs/react';

interface Props {
    books: any[];
    categories: any[];
    filters: {
        search?: string;
        category?: string;
    };
}

export default function Browse({ books, categories, filters }: Props) {
    const [search, setSearch] = React.useState(filters.search || '');

    const handleSearch = (e: React.FormEvent) => {
        e.preventDefault();
        router.get(route('books.browse'), { search, category: filters.category }, { preserveState: true });
    };

    return (
        <NgawiLayout>
            <Head title="Jelajah Koleksi" />
            
            <div className="fade-in">
                <div className="text-center mb-5">
                    <h2 className="fw-black text-primary-custom display-5 mb-2">KATALOG KOLEKSI</h2>
                    <p className="text-muted">Cari dan temukan buku impianmu di ribuan koleksi kami.</p>
                </div>

                {/* Filter & Search */}
                <div className="card glass-card border-0 shadow-sm p-4 mb-5">
                    <form className="row g-3" onSubmit={handleSearch}>
                        <div className="col-md-7">
                            <div className="input-group">
                                <span className="input-group-text bg-white border-0 shadow-sm"><i className="bi bi-search text-primary"></i></span>
                                <input 
                                    type="text" 
                                    className="form-control border-0 shadow-sm py-2 px-3" 
                                    placeholder="Cari Judul Buku atau Penulis..."
                                    value={search}
                                    onChange={(e) => setSearch(e.target.value)}
                                />
                            </div>
                        </div>
                        <div className="col-md-3">
                            <select 
                                className="form-select border-0 shadow-sm py-2"
                                value={filters.category || ''}
                                onChange={(e) => router.get(route('books.browse'), { search, category: e.target.value })}
                            >
                                <option value="">Semua Kategori</option>
                                {categories.map(cat => (
                                    <option key={cat.id} value={cat.id}>{cat.name}</option>
                                ))}
                            </select>
                        </div>
                        <div className="col-md-2 d-grid">
                            <button type="submit" className="btn btn-primary fw-bold rounded-pill">CARI</button>
                        </div>
                    </form>
                </div>

                {/* Books Grid */}
                <div className="row g-4">
                    {books.length > 0 ? books.map((book) => (
                        <div className="col-md-3" key={book.id}>
                            <div className="card glass-card border-0 shadow-sm h-100 overflow-hidden hover-scale">
                                <div style={{ height: '280px', backgroundColor: '#f8f9fa' }} className="d-flex align-items-center justify-content-center border-bottom position-relative">
                                    {book.cover_image ? (
                                        <img src={`/storage/${book.cover_image}`} className="w-100 h-100 object-fit-cover" alt={book.title} />
                                    ) : (
                                        <i className="bi bi-book fs-1 opacity-25 text-primary"></i>
                                    )}
                                    <div className="position-absolute top-0 end-0 m-2">
                                        <span className="badge bg-warning text-dark rounded-pill px-3 shadow-sm">{book.category.name}</span>
                                    </div>
                                </div>
                                <div className="card-body p-4">
                                    <h5 className="fw-bold mb-1 text-truncate" title={book.title}>{book.title}</h5>
                                    <p className="small text-muted mb-3"><i className="bi bi-person me-1"></i> {book.author.name}</p>
                                    
                                    <div className="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                        <span className={`small fw-bold ${book.stock > 0 ? 'text-success' : 'text-danger'}`}>
                                            {book.stock > 0 ? `${book.stock} Tersedia` : 'Stok Habis'}
                                        </span>
                                        <Link 
                                            href={route('books.borrow', book.id)} 
                                            method="post" 
                                            as="button" 
                                            className={`btn btn-sm ${book.stock > 0 ? 'btn-primary' : 'btn-secondary disabled'} rounded-pill px-3 fw-bold`}
                                            disabled={book.stock <= 0}
                                        >
                                            PINJAM
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    )) : (
                        <div className="col-12 text-center py-5 opacity-50">
                            <i className="bi bi-search display-1"></i>
                            <h4 className="mt-3">Buku tidak ditemukan.</h4>
                            <p>Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                        </div>
                    )}
                </div>
            </div>
        </NgawiLayout>
    );
}
