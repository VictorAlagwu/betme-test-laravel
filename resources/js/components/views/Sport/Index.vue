<template>
    <div>
        <h2 class="text-center">Sports List</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <!-- <th>Detail</th> -->
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                <tr v-for="sport in sports" :key="sport.id">
                    <td>{{ sport.id }}</td>
                    <td>{{ sport.name }}</td>
                    <!-- <td>{{ product.detail }}</td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            sports: [],
        };
    },
    created() {
        this.handleFetchSports();
    },
    methods: {
        async handleFetchSports() {
            try {
                let url = "http://127.0.0.1:8000/api/v1/sports";
                let response = await this.axios.get(url);
                if (response.data) {
                    this.sports = response.data;
                }
                console.log(re);
            } catch (error) {
                console.log("Error: " + error.message);
            }
        },
    },
};
</script>
