<template>
    <div class="flex justify-center py-5 bg-white border-gray">
        <div class="w-full max-w-md">
            <!-- Tabs -->
            <div class="flex border-b gap-5" style="justify-content: center;">
                <div
                    :class="['w-1/2 text-center py-4 text-lg font-semibold', { 'text-black border-b-2 border-black': currentTab === 'signup', 'text-gray-500': currentTab !== 'signup' }]"
                    @click="currentTab = 'signup'"
                >
                    <button class="focus:outline-none">انشاء حساب</button>
                </div>
                <div class="flex flex-grow h-px mx-2 bg-gray-200"></div>
                <div
                    :class="['w-1/2 text-center py-4 text-lg font-semibold', { 'text-black border-b-2 border-black': currentTab === 'login', 'text-gray-500': currentTab !== 'login' }]"
                    @click="currentTab = 'login'"
                >
                    <button class="focus:outline-none">تسجيل الدخول</button>
                </div>
            </div>

            <!-- Content -->
            <div class="mt-8 px-8" v-if="currentTab === 'login'">
                <h1 class="text-2xl font-semibold text-center">تسجيل الدخول</h1>
                <p class="text-gray-500 text-center mt-2">
                    تسجيل الدخول للأستمتاع بجميع المزايا لدينا
                </p>
                <!-- Phone Number Input -->
                <div class="mt-8">
                    <label class="block mb-2 text-right font-medium text-gray-700">رقم الهاتف</label>
                    <div class="flex items-center border rounded-md p-2">
                        <div class="flex items-center p-2 border-r border-gray-300">
                            <img src="" alt="country flag" class="h-6 w-6">
                            <span class="ml-2 font-semibold">+02</span>
                        </div>
                        <input type="text" placeholder="رقم الهاتف" class="flex-1 p-2 outline-none">
                    </div>
                </div>
                <!-- Alternative Login Option -->
                <a class="text-center" href="#"><p class="text-center text-gray-500 mt-4">او الدخول عن طريق رقم البريد الألكتروني</p></a>
                <!-- Submit Button -->
                <button class="mt-8 w-full py-3 bg-gray-100 text-lg font-medium rounded-md">التالي</button>
            </div>

            <div class="mt-8 px-8" v-else-if="currentTab === 'signup'">
                <h1 class="text-2xl font-semibold text-center">انشاء حساب</h1>
                <p class="text-gray-500 text-center mt-2 ">
                    انشاء حساب للاستمتاع بجميع المزايا لدينا
                </p>
                <!-- first & last Input -->
                <div class="col-12  gap-2 mt-2">
                    <div class="row">
                        <div class="col-6 p-0">
                            <label class="block mb-2 text-right font-medium text-gray-700">الاسم الاول</label>
                            <div class="flex items-center border rounded-md p-1 h-10">
                                <input type="text" placeholder="الاسم الاول" class="flex-1 outline-none">
                            </div>
                        </div>
                        <div class="col-6 p-0">
                            <label class="block mb-2 text-right font-medium text-gray-700">الاسم الاخير</label>
                            <div class="flex items-center border rounded-md p-1 h-10">
                                <input type="text" placeholder="الاسم الاخير" class="flex-1 outline-none">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Phone Number Input -->
                <div class="mt-4">
                    <label class="block mb-2 text-right font-medium text-gray-700">رقم الهاتف</label>
                    <div class="flex items-center border rounded-md p-1">
                        <div class="flex items-center p-2 border-r border-gray-300">
                            <img src="" alt="country flag" class="h-6 w-6">
                            <span class="ml-2 font-semibold">+02</span>
                        </div>
                        <input type="text" placeholder="رقم الهاتف" class="flex-1 p-2 outline-none">
                    </div>
                </div>
                <!-- Email Input -->
                <div class="mt-4">
                    <label class="block mb-2 text-right font-medium text-gray-700">البريد الالكتروني</label>
                    <input type="email" placeholder="البريد الالكتروني" class="w-full p-2 border rounded-md outline-none">
                </div>
                <!-- Passwod Input -->
                <div class="mt-4">
                    <label class="block mb-2 text-right font-medium text-gray-700">كلمة المرور</label>
                    <input type="password" placeholder="كلمة المرور" class="w-full p-2 border rounded-md outline-none">
                </div>
                <!-- date & gender Input -->
                <div class="col-12 gap-2">
                    <div class="row">
                        <div class="col-6 p-0 gap-2">
                            <label class="block mb-2 text-right font-medium text-gray-700">الجنس</label>
                            <div class="flex items-center border rounded-md p-1 h-10">
                                <select name="gender" id="gender" class="flex-1 outline-none">
                                    <option value="male">male</option>
                                    <option value="female">female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 p-0">
                            <label class="block mb-2 text-right font-medium text-gray-700">تاريخ الميلاد</label>
                            <div class="flex items-center border rounded-md p-1 h-10">
                                <input type="date"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <button class="mt-8 w-full py-3 bg-gray-100 text-lg font-medium rounded-md">التالي</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "LoginSignupScreen",
    data() {
        return {
            currentTab: 'login'
        }
    }
};
</script>

<style>
</style>
