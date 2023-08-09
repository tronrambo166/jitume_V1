<template>
    <!-- <div class="container" id=""> -->



    <!-- PAGE CONTENT -->
    <div class="row service_img mx-auto text-center">

        <div class="container-xl col-sm-12 text-center p-5" style="min-height: 600px;">

            <div class="py-5"></div>
            <div class=" mt-5 mb-5 pb-2 mx-auto text-center">
                <h2 style="font-size: 60px; font-weight: bold; font-style: normal; text-shadow: 3px 3px #2a2a2c ; "
                    class="text-light ">
                    Looking for...
                </h2>
            </div>

            <form id="form" @submit.prevent="search();" class="container w-100 mb-5 pb-5" method="post">
                <div class="w-100 text-center py-1 rounded text-center d-md-flex justify-content-between bg-white">

                    <div style="border-radius: 35px 0 0 35px;" class="px-2 py-2 bg-white">
                        <input required="" style="border: none;height: 42px;" class="bar bg-white form-control d-inline"
                            type="text" name="listing_name" placeholder="What are you looking for?">
                    </div>

                    <div style="" class="px-2 py-2 bg-white">
                        <input id="searchbox" required="" onkeyup="suggest(this.value);" style="border: none;height: 42px;"
                            class="border-none bar bg-white form-control d-inline" type="text" name="search" value=""
                            placeholder="Location">

                    </div>

                    <div class="px-2 py-2 bg-white d-flex justify-centent-evenly align-items-center">
                        <div class="dropdown d-flex align-items-center">

                            <select name="category" required class="border-none form-control">
                                <option hidden value="" class="form-control">Services</option>
                                <option class="form-control" value="Business Planning">Business Planning</option>
                                <option value="IT">IT</option>
                                <option value="Legal Project Management">Legal Project Management</option>
                                <option value="Branding and Design">Branding and Design </option>
                                <option value="Auto">Auto</option>
                                <option value="Finance, Accounting & 
                Tax Marketing">Finance, Accounting &
                                    Tax Marketing</option>
                                <option value="Tax Marketing">Tax Marketing</option>
                                <option value="Public Relations">Public Relations</option>
                                <option value="Other">Other</option>

                            </select>

                        </div>

                        <div style="border-radius: 0 35px 35px 0;" class="bg-white d-flex align-items-center px-2">
                            <button class="px-sm-3 px-1 searchListing py-1" type="submit">Search</button>
                        </div>

                    </div>



                </div>

                <div class="row" style="">
                    <div id="result_list" class="text-left"
                        style="display: none;width:32%; z-index: 1000;height: 600px;position: absolute; margin-left: 378px;top: 330px;">
                    </div>
                </div>

            </form>
        </div>

    </div>

    <!-- PAGE CONTENT -->



    <!-- </div> -->
</template>

<script>

export default {
    props: ['auth_user'],
    data: () => ({
        res: [],
        emptyCat: false
    }),

    created() {
        console.log(this.$router.currentRoute.path);
        document.getElementById('c_to_ac').innerHTML = 'Add Your Service';
        $('#call_to').html('');
        $('#call_to').html('<a onclick="c_to_actionS();" data-target="#loginModal" data-toggle="modal" class="header_buttons text-light px-sm-3 my-1 px-1 py-1 mx-1 d-inline-block small text-center" ><span style="font-weight:bolder;" id="c_to_ac">Add Your Service</span></a> ');



    },
    methods: {

        search() {
            const form = $('#form');
            var thiss = this;
            var ids = '';

            $.ajax({
                url: 'searchService',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: 'json',
                data: form.serialize(),
                success: function (response) {
                    console.log(response);

                    Object.entries(response.results).forEach(entry => {
                        const [index, row] = entry;
                        ids = ids + row.id + ',';
                    });//console.log(ids);

                    if (ids == '')
                        ids = 'no-results'
                    //thiss.$router.push({ path: '/listingResults', query: { result: response } })
                    thiss.$router.push({ name: 'serviceResults', params: { results: ids } })
                },
                error: function (response) {
                    console.log(response);
                }
            });
        },

        replaceText() {
            if (this.$router.currentRoute.path == '/services' ||
                this.$router.currentRoute.path == '/serviceResults') {
                $('#call_to').html('');
                $('#call_to').html('<a onclick="c_to_actionS();" data-target="#loginModal" data-toggle="modal" class="header_buttons text-light px-sm-3 my-1 px-1 py-1 mx-1 d-inline-block small text-center" ><span style="font-weight:bolder;" id="c_to_ac">Add Your Service</span></a> ');
            }
        }

    },

    mounted() {
        //return this.$store.dispatch("fetchpro")
        this.replaceText();
        //$('#create_investor').html('');
    }

}
</script>
