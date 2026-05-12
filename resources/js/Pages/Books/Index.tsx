import React from 'react';
import NgawiLayout from '@/Layouts/NgawiLayout';
import { Head, Link, router } from '@inertiajs/react';

interface Props {
    books: {
        data: any[];
        links: any[];
    };
}

export default function Index({ books }: Props) {
    const deleteBook = (id: number) => {
        if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
            router.delete(route('staff.books.destroy', id));
        }
    };

    return (
        <NgawiLayout>
            <Head title="Manajemen Buku" />
            
            <div className="fade-in">
                <div className="d-flex justify-content-between align-items-center mb-4">
                    <h3 className="fw-bold text-primary-custom mb-0"><i className="bi bi-journals me-2"></i> Kelola Koleksi Buku</h3>
                    <Link href={route('staff.books.create')} className="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                        <i className="bi bi-plus-lg me-2"></i> TAMBAH BUKU
                    </Link>
                </div>

                <div className="card glass-card border-0 shadow-lg overflow-hidden">
                    <div className="table-responsive">
                        <table className="table table-hover align-middle mb-0">
                            <thead className="bg-dark text-white">
                                <tr>
                                    <th className="px-4 py-3">Sampul</th>
                                    <th className="px-4 py-3">Judul</th>
                                    <th className="px-4 py-3">Penulis / Kategori</th>
                                    <th className="px-4 py-3 text-center">Stok</th>
                                    <th className="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody className="bg-white">
                                {books.data.map((book) => (
                                    <tr key={book.id}>
                                        <td className="px-4 py-3" style={{ width: '100px' }}>
                                            <div className="bg-light rounded p-1 text-center">
                                                {book.cover_image ? (
                                                    <img src={`/storage/${book.cover_image}`} className="rounded" style={{ width: '50px', height: '70px', objectFit: 'cover' }} alt="" />
                                                ) : (
                                                    <i className="bi bi-book opacity-25"></i>
                                                )}
                                            </div>
                                        </td>
                                        <td className="px-4 py-3">
                                            <div className="fw-bold">{book.title}</div>
                                            <div className="x-small text-muted">ISBN: {book.isbn || '-'}</div>
                                        </td>
                                        <td className="px-4 py-3">
                                            <div className="small fw-bold text-primary">{book.author.name}</div>
                                            <div className="badge bg-secondary-subtle text-secondary rounded-pill x-small mt-1">{book.category.name}</div>
                                        </td>
                                        <td className="px-4 py-3 text-center">
                                            <span className={`fw-bold ${book.stock < 5 ? 'text-danger' : 'text-success'}`}>{book.stock}</span>
                                        </td>
                                        <td className="px-4 py-3 text-center">
                                            <div className="d-flex justify-content-center gap-2">
                                                <Link href={route('staff.books.edit', book.id)} className="btn btn-sm btn-outline-warning rounded-pill px-3">
                                                    <i className="bi bi-pencil-square"></i>
                                                </Link>
                                                <button onClick={() => deleteBook(book.id)} className="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                    <i className="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </NgawiLayout>
    );
}
