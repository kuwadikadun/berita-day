import React, { useState } from "react";
import { Link, Head, router } from "@inertiajs/react";
import Navbar from "@/Components/Navbar";

export default function EditNews(props) {
    const [title, setTitle] = useState("");
    const [description, setDescription] = useState("");
    const [category, setCategory] = useState("");
    // const [isNotif, setIsNotif] = useState(false);

    const handleSubmit = () => {
        const data = {
            id: props.myNews.id,
            title,
            description,
            category,
        };

        router.post("/news/update", data);
        // setIsNotif(true);
        setTitle("");
        setDescription("");
        setCategory("");
    };

    // console.log(props);
    return (
        <div className="min-h-screen bg-slate-5">
            <Navbar user={props.auth.user} />
            <Head title="Edit Berita" />
            <div className="card mt-10 w-full bg-base-100 shadow-xl ">
                <div className="p-4 text-2xl">Edit Berita</div>
                <div className="card-body">
                    <input
                        type="text"
                        placeholder="Judul"
                        className="input input-bordered w-full m-2"
                        onChange={(title) => setTitle(title.target.value)}
                        defaultValue={props.myNews.title}
                    />
                    <input
                        type="text"
                        placeholder="Deskripsi"
                        className="input input-bordered w-full m-2"
                        onChange={(description) =>
                            setDescription(description.target.value)
                        }
                        defaultValue={props.myNews.description}
                    />
                    <input
                        type="text"
                        placeholder="Kategori"
                        className="input input-bordered w-full m-2"
                        onChange={(category) =>
                            setCategory(category.target.value)
                        }
                        defaultValue={props.myNews.category}
                    />
                    <button
                        className="btn btn-primary m-2"
                        onClick={() => handleSubmit()}
                    >
                        UPDATE
                    </button>
                </div>
            </div>
        </div>
    );
}
