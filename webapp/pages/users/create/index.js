import Head from 'next/head'
import { Inter } from 'next/font/google'
import { useEffect, useState } from "react"
import { createUserApi } from '@/services/API.services'
import { toast } from 'react-toastify'
import { useRouter } from "next/router"
import { useForm } from "react-hook-form"
import { yupResolver } from "@hookform/resolvers/yup"
import userRules from '@/validate/userRules';

const inter = Inter({ subsets: ['latin'] })

export default function Index() {
    const router = useRouter()

    const formOptions = { resolver: yupResolver(userRules) };
    const { register, handleSubmit, reset, formState } = useForm(formOptions);
    const { errors, isSubmitting } = formState

    const handleCreateUser = async (data) => {
        try {
            const res = await createUserApi(data)
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
            <title>Create user</title>
            <meta name="description" content="Generated by create next app" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <link rel="icon" href="/favicon.ico" />
        </Head>
        <main className="container">
            <h2>Create User</h2>
            <div className="create-user">
                <form onSubmit={handleSubmit(handleCreateUser)} className="row g-3">
                    <div className="col-md-6">
                        <label className="form-label">First Name</label>
                        <input
                            {...register("first_name")}
                            type="text"
                            className="form-control"
                            placeholder="First name"
                        />
                        {errors.first_name && <div className="alert alert-danger ml-2 mt-2">{errors.first_name?.message}</div>}
                    </div>
                    <div className="col-6">
                        <label className="form-label">Last Name</label>
                        <input
                            {...register("last_name")}  
                            type="text"
                            className="form-control"
                            placeholder="Last name"
                        />
                        {errors.last_name && <div className="alert alert-danger ml-2 mt-2">{errors.last_name?.message}</div>}
                    </div>
                    <div className="col-md-6">
                        <label className="form-label">Email</label>
                        <input 
                            {...register("email")}
                            type="email" 
                            className="form-control"
                            placeholder="Email"
                        />
                        {errors.email && <div className="alert alert-danger ml-2 mt-2">{errors.email?.message}</div>}
                    </div>

                    <div>
                        <button onClick={() => reset()} className="btn btn-secondary" variant="secondary">Reset</button>
                        <button disabled={isSubmitting} className="btn btn-primary ms-2" type="submit" variant="primary">Save</button>
                    </div>
                </form>
            </div>
        </main>
    </>
  )
}
