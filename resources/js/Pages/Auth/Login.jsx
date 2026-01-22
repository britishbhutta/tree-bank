// import Checkbox from '@/Components/Checkbox';
// import InputError from '@/Components/InputError';
// import InputLabel from '@/Components/InputLabel';
// import PrimaryButton from '@/Components/PrimaryButton';
// import TextInput from '@/Components/TextInput';
// import GuestLayout from '@/Layouts/GuestLayout';
// import { Head, Link, useForm } from '@inertiajs/react';

// export default function Login({ status, canResetPassword }) {
//     const { data, setData, post, processing, errors, reset } = useForm({
//         email: '',
//         password: '',
//         remember: false,
//     });

//     const submit = (e) => {
//         e.preventDefault();

//         post(route('login'), {
//             onFinish: () => reset('password'),
//         });
//     };

//     return (
//         <GuestLayout>
//             <Head title="Log in" />

//             {status && (
//                 <div className="mb-4 text-sm font-medium text-green-600">
//                     {status}
//                 </div>
//             )}

//             <form onSubmit={submit}>
//                 <div>
//                     <InputLabel htmlFor="email" value="Email" />

//                     <TextInput
//                         id="email"
//                         type="email"
//                         name="email"
//                         value={data.email}
//                         className="mt-1 block w-full"
//                         autoComplete="username"
//                         isFocused={true}
//                         onChange={(e) => setData('email', e.target.value)}
//                     />

//                     <InputError message={errors.email} className="mt-2" />
//                 </div>

//                 <div className="mt-4">
//                     <InputLabel htmlFor="password" value="Password" />

//                     <TextInput
//                         id="password"
//                         type="password"
//                         name="password"
//                         value={data.password}
//                         className="mt-1 block w-full"
//                         autoComplete="current-password"
//                         onChange={(e) => setData('password', e.target.value)}
//                     />

//                     <InputError message={errors.password} className="mt-2" />
//                 </div>

//                 <div className="mt-4 block">
//                     <label className="flex items-center">
//                         <Checkbox
//                             name="remember"
//                             checked={data.remember}
//                             onChange={(e) =>
//                                 setData('remember', e.target.checked)
//                             }
//                         />
//                         <span className="ms-2 text-sm text-gray-600">
//                             Remember me
//                         </span>
//                     </label>
//                 </div>

//                 <div className="mt-4 flex items-center justify-end">
//                     {canResetPassword && (
//                         <Link
//                             href={route('password.request')}
//                             className="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
//                         >
//                             Forgot your password?
//                         </Link>
//                     )}

//                     <PrimaryButton className="ms-4" disabled={processing}>
//                         Log in
//                     </PrimaryButton>
//                 </div>
//             </form>
//         </GuestLayout>
//     );
// }

import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import InputError from '@/Components/InputError';
import TextInput from '@/Components/TextInput';
import InputLabel from '@/Components/InputLabel';
import { useNavigate } from 'react-router-dom';
import { useLocation } from "react-router-dom";
import Swal from 'sweetalert2';
import axios from "axios";
import {useAuth } from './useAuth.jsx';


export default function Login() {
  const { fetchUser } = useAuth();
//   useEffect(() => {
//   axios.get("/sanctum/csrf-cookie", {
//     withCredentials: true
//   });
// }, []);
  const location = useLocation();
  useEffect(() => {
          if (location.state?.message) {
              Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: location.state.message,
                  timer: 3000,
                  showConfirmButton: false,
              });
          }
      }, []);
  const navigate = useNavigate();
  const initialData = {
    email: '',
    password: '',
  };
  const [data, setData] = useState(initialData);
  const [errors, setErrors] = useState({});
    const [processing, setProcessing] = useState(false);

    const handleChange = (e) => {
        setData({
            ...data,
            [e.target.name]: e.target.value,
        });
    };

    const submit = async (e) => {
  e.preventDefault();
  setProcessing(true);
  setErrors({});

  try {
    const response = await axios.post("/getLogin", data);
    setData(initialData);
    setErrors({});
    await fetchUser();
    navigate("/home", {
      state: {
        message: response.data.message
      }
    });

  } catch (error) {
    if (error.response?.status === 422) {
      setErrors(error.response.data.errors || {});
    } else {
      console.error("Login error:", error);
    }
  } finally {
    setProcessing(false);
  }
};


  return (
    <div className="min-h-[40vh] flex items-center justify-center px-4 mt-8">
      <form onSubmit={submit}
        className={`w-full max-w-xl bg-white p-8 rounded-2xl shadow-lg transition-all duration-300`}
        >
          <div
              className="grid gap-4 grid-cols-1 md">
              <InputLabel htmlFor="email">Email<span className="text-red-500 ml-1">*</span></InputLabel>
              <TextInput
                type="email"
                name="email"
                placeholder="Email"
                value={data.email}
                onChange={handleChange}
                className="mt-1 block w-full p-2 mb-4"
              />
              <InputError message={errors.email?.[0]} />
              
              <InputLabel htmlFor="password">Password<span className="text-red-500 ml-1">*</span></InputLabel>
              <TextInput
                type="password"
                name="password"
                placeholder="Password"
                value={data.password}
                onChange={handleChange}
                className="mt-1 block w-full p-2 mb-4"
              />
              <InputError message={errors.password?.[0]} />

              <button type="submit" className="w-full bg-green-600 text-white p-2 rounded rounded-full hover:bg-green-700 hover:-translate-y-1 duration-300 mt-4" disabled={processing}>
                {processing ? 'Logging In...' : 'Log In'}
              </button>
            </div>
            <div className="mt-4 text-center">
                <Link
                    to="/register"
                    className="text-sm text-gray-600 underline hover:text-gray-900"
                >
                    Get Registered
                </Link>
            </div>
        </form>
    </div>
  );
}
