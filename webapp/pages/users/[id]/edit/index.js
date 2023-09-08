import Head from 'next/head'
import { Inter } from 'next/font/google'
import { useEffect, useState } from "react"
import { editUserApi, getUserApi } from '@/services/API.services'
import { toast } from 'react-toastify';
import { useRouter } from "next/router"
import Link from 'next/link'

const inter = Inter({ subsets: ['latin'] })

export default function Index() {
    const router = useRouter()
    const [user, setUser] = useState([])
    const [processing, setProcessing] = useState(false);
    const [email, setEmail] = useState(user.email || "")
    const [first_name, setFirstName] = useState(user.first_name || "")
    const [status, setStatus] = useState(user.status || "")
    const [last_name, setLastName] = useState(user.last_name || "")

    const userStatus = [
        {
            value: 1,
            label: 'Active',
        },
        {
            value: 2,
            label: 'Suspended',
        },
        {
            value: 3,
            label: 'Deleted',
        },
    ];
    
    useEffect(() => {
        const { id } = router.query
        if (id) {
            getUser(id)
        }
    }, [router.query])

    useEffect(() => {
        if (user) {
            setEmail(user.email)
            setFirstName(user.first_name)
            setLastName(user.last_name)
            setStatus(user.status)
        }
      }, [user])

    const getUser = async (id) => {
        try {
            const res = await getUserApi(id)
            setUser(res.data)
        } catch (e) {
            toast.error(e.message)
        }
    }

    const handleUpdateUser = async (event) => {
        event.preventDefault();
        let data = {email, first_name, last_name, status}
        try {
            const res = await editUserApi(user.id, data)
            if (res.status) {
                toast.success(res.message)
                router.push('/users')
            }
        } catch (e) {
            toast.error(e.message)
        }
    }

  return (
    <>
        <Head>
            <title>Update user</title>
            <meta name="description" content="Generated by create next app" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <link rel="icon" href="/favicon.ico" />
        </Head>
        <main className="container">
            <h2>Update user</h2>
            <div className="create-user">
                <form onSubmit={handleUpdateUser} className="row g-3">
                    <div className="col-md-6">
                        <label className="form-label">First Name</label>
                        <input
                            type="text"
                            className="form-control"
                            placeholder="First name"
                            value={first_name}
                            onChange={event => setFirstName(event.target.value)}
                        />
                    </div>
                    <div className="col-6">
                        <label className="form-label">Last Name</label>
                        <input 
                            type="text"
                            className="form-control"
                            placeholder="Last name"
                            value={last_name}
                            onChange={event => setLastName(event.target.value)}
                        />
                    </div>
                    <div className="col-md-6">
                        <label className="form-label">Email</label>
                        <input 
                            type="email" 
                            className="form-control"
                            value={email}
                            placeholder="Email"
                            onChange={event => setEmail(event.target.value)}
                        />
                    </div>
                    <div className="col-md-6">
                        <label className="form-label">Status</label>
                        <select onChange={event => setStatus(event.target.value)}
                            class="form-select">
                            {
                                userStatus.map((item, key) => {
                                    return (
                                        <option key={`status-${key}`} selected={user.status == item.value} value={item.value}>{item.label}</option>
                                    )
                                })
                            }
                        </select>
                    </div>

                    <div>
                        <Link href="/users">
                            <button className="btn btn-secondary" variant="secondary">Back</button>
                        </Link>
                        <button className="btn btn-primary ms-2" type="submit" variant="primary">Save</button>
                    </div>
                </form>
            </div>
        </main>
    </>
  )
}
