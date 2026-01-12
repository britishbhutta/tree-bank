import { useState } from 'react';
import { Link } from 'react-router-dom';

import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';

export default function Register() {
    const [data, setData] = useState({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',

    address: '',
    city: '',
    tehsil: '',
    district: '',

    account_type: 'individual', // 👈 default

    // company fields
    company_name: '',
    company_email: '',
    company_phone: '',
    department: '',
    company_address: '',
    company_city: '',
    company_tehsil: '',
    company_district: '',
});


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
        const response = await fetch('/getRegistered', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
            },
            body: JSON.stringify(data),
        });

        const result = await response.json();

        if (response.status === 422) {
            // Validation failed
            setErrors(result.errors || {});
        } else if (response.ok) {
            // Success
            alert('Registered successfully!');
        } else {
            console.error('Unexpected response:', result);
        }
    } catch (error) {
        console.error('Fetch error:', error);
    } finally {
        setProcessing(false);
    }
};


    return (
    <>
        <div className="min-h-[70vh] flex items-center justify-center px-4 mt-8">
            <form
                onSubmit={submit}
                className={`w-full ${
                    data.account_type === 'company' ? 'max-w-5xl' : 'max-w-xl'
                } bg-white p-8 rounded-2xl shadow-lg transition-all duration-300`}
            >
                <div
                    className={`grid gap-8 ${
                        data.account_type === 'company'
                            ? 'grid-cols-1 md:grid-cols-2'
                            : 'grid-cols-1'
                    }`}
                >
                    {/* LEFT SIDE */}
                    <div>
                        <h3 className="text-lg font-semibold mb-4 text-green-700 mt-9">
                            Personal Details
                        </h3>
                        <div className="mt-4">
                            <InputLabel htmlFor="name" value="Name" />
                            <TextInput
                                id="name"
                                name="name"
                                value={data.name}
                                onChange={handleChange}
                                className="mt-1 block w-full p-2 mb-4"
                                placeholder="Type Name"
                                
                            />
                            <InputError message={errors.name?.[0]} />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                name="email"
                                value={data.email}
                                onChange={handleChange}
                                className="mt-1 block w-full p-2 mb-4"
                                placeholder="Type Email"
                                
                            />
                            <InputError message={errors.email?.[0]} />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="password" value="Password" />
                            <TextInput
                                id="password"
                                type="password"
                                name="password"
                                value={data.password}
                                onChange={handleChange}
                                className="mt-1 block w-full p-2 mb-4"
                                placeholder="Type Password"
                                
                            />
                            <InputError message={errors.password?.[0]} />
                        </div>

                        <div className="mt-4">
                            <InputLabel
                                htmlFor="password_confirmation"
                                value="Confirm Password"
                            />
                            <TextInput
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                value={data.password_confirmation}
                                onChange={handleChange}
                                className="mt-1 block w-full p-2 mb-4"
                                placeholder="Confirm Password"
                                
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel value="Address" />
                            <TextInput
                                name="address"
                                placeholder="Type Address"
                                value={data.address}
                                onChange={handleChange}
                                className="w-full p-2 mb-4"
                                
                            />
                            <InputError message={errors.address?.[0]} />
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <TextInput
                                name="city"
                                placeholder="City"
                                value={data.city}
                                onChange={handleChange}
                                className="p-2"
                                
                            />
                            
                            <TextInput
                                name="tehsil"
                                placeholder="Tehsil"
                                value={data.tehsil}
                                onChange={handleChange}
                                className="p-2"
                                
                            />
                            <TextInput
                                name="district"
                                placeholder="District"
                                value={data.district}
                                onChange={handleChange}
                                className="p-2"
                                
                            />
                        </div>
                        <InputError message={errors.city?.[0]} />
                        <InputError message={errors.tehsil?.[0]} />
                        <InputError message={errors.district?.[0]} />
                        <div className="mt-6">
                            <InputLabel value="Account Type" />
                            <div className="flex gap-6 mt-2">
                                <label className="flex items-center gap-2">
                                    <input
                                        type="radio"
                                        name="account_type"
                                        value="individual"
                                        checked={data.account_type === 'individual'}
                                        onChange={handleChange}
                                    />
                                    Individual
                                </label>

                                <label className="flex items-center gap-2">
                                    <input
                                        type="radio"
                                        name="account_type"
                                        value="company"
                                        checked={data.account_type === 'company'}
                                        onChange={handleChange}
                                    />
                                    Company
                                </label>
                            </div>
                        </div>

                        <div className="mt-6">
                            <button
                                className="w-full bg-green-600 text-white p-3 rounded-full hover:bg-green-700 transition"
                                disabled={processing}
                            >
                                {processing ? 'Registering...' : 'Register'}
                            </button>
                        </div>

                        <div className="mt-4 text-center">
                            <Link
                                to="/login"
                                className="text-sm text-gray-600 underline hover:text-gray-900"
                            >
                                Already registered?
                            </Link>
                        </div>
                    </div>

                    {/* RIGHT SIDE – COMPANY */}
                    {data.account_type === 'company' && (
                        <div className="p-6 rounded-xl">
                            <h3 className="text-lg font-semibold mb-4 text-green-700">
                                Company Details
                            </h3>
                            <InputLabel value="Name" />
                            <TextInput
                                name="company_name"
                                placeholder="Type Name"
                                value={data.company_name}
                                onChange={handleChange}
                                className="w-full p-2 mb-3"
                                
                            />
                            <InputError message={errors.company_name?.[0]} />
                            <InputLabel value="Email" />
                            <TextInput
                                name="company_email"
                                type="email"
                                placeholder="Type Email"
                                value={data.company_email}
                                onChange={handleChange}
                                className="w-full p-2 mb-3"
                                
                            />
                            <InputError message={errors.company_email?.[0]} />
                            <InputLabel value="Phone" />
                            <TextInput
                                name="company_phone"
                                placeholder="Type Phone"
                                value={data.company_phone}
                                onChange={handleChange}
                                className="w-full p-2 mb-3"
                                
                            />
                            <InputError message={errors.company_phone?.[0]} />
                            <InputLabel value="Department" />
                            <TextInput
                                name="department"
                                placeholder="Department"
                                value={data.department}
                                onChange={handleChange}
                                className="w-full p-2 mb-3"
                                
                            />
                            <InputError message={errors.department?.[0]} />
                            <InputLabel value="Address" />
                            <TextInput
                                name="company_address"
                                placeholder="Type Address"
                                value={data.company_address}
                                onChange={handleChange}
                                className="w-full p-2 mb-3"
                                
                            />
                            <InputError message={errors.company_address?.[0]} />
                            <div className="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <TextInput
                                    name="company_city"
                                    placeholder="City"
                                    value={data.company_city}
                                    onChange={handleChange}
                                    className="p-2"
                                    
                                />
                                <TextInput
                                    name="company_tehsil"
                                    placeholder="Tehsil"
                                    value={data.company_tehsil}
                                    onChange={handleChange}
                                    className="p-2"
                                    
                                />
                                <TextInput
                                    name="company_district"
                                    placeholder="District"
                                    value={data.company_district}
                                    onChange={handleChange}
                                    className="p-2"
                                    
                                />
                            </div>
                            <InputError message={errors.company_city?.[0]} />
                            <InputError message={errors.company_tehsil?.[0]} />
                            <InputError message={errors.company_district?.[0]} />
                        </div>
                    )}
                </div>
            </form>
        </div>
    </>
);

}
