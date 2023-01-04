<template>
  <div class="container">
    <div
      style="
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
      "
    >
      <div
        class="card"
        style="width: 100%; padding: 10px; padding-bottom: 20px"
      >
        <div class="card-body">
          <h5 class="card-title">Create new post:</h5>
          <form v-on:submit.prevent="createNewPost(postName, postDescription)">
            <input
              v-model="postName"
              type="text"
              class="form-control"
              aria-label="Small"
              aria-describedby="inputGroup-sizing-sm"
            />
            <input
              v-model="postDescription"
              type="text"
              class="form-control"
              aria-label="Small"
              aria-describedby="inputGroup-sizing-sm"
            />
            <input type="submit" value="Create" />
          </form>
        </div>
      </div>

      <div
        v-for="post in posts"
        :key="post.id"
        class="card"
        style="width: 100%; padding: 10px; padding-bottom: 20px"
      >
        <div class="card-body">
          <h5 class="card-title">"{{ post.name }}"</h5>
          <p class="card-text">
            {{ post.description }}
          </p>
        </div>
        <div>
          <h6 style="padding-left: 5px">Write comment:</h6>
          <form v-on:submit.prevent="sendComment(comment, post.id)">
            <input
              v-model="comment"
              type="text"
              class="form-control"
              aria-label="Small"
              aria-describedby="inputGroup-sizing-sm"
            />
            <input type="submit" value="Comment" />
          </form>
        </div>
        <div class="card" style="width: 100%">
          <div
            v-for="c in comments"
            :key="c.id"
            class="list-group list-group-flush"
            style="border: 0px"
          >
            <div v-if="post.id == c.post_id">
              <li class="list-group-item">
                {{ c.comment }}
              </li>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "HelloWorld",
  data() {
    return {
      posts: {},
      comments: {},
    };
  },
  props: {},
  created() {
    this.fetchPosts();
    this.fetchComments();
  },
  methods: {
    async fetchPosts() {
      await fetch("http://127.0.0.1:8001/api/getAllPosts")
        .then((response) => response.json())
        .then((data) => (this.posts = data))
        .catch((err) => console.error(err));
    },
    async fetchComments() {
      await fetch("http://127.0.0.1:8002/api/getAllComments")
        .then((response) => response.json())
        .then((data) => (this.comments = data))
        .catch((err) => console.error(err));
    },

    createNewPost(name, description) {

      let newPost = {
        postName: name,
        postDescription: description,
      };

      axios
        .post("http://127.0.0.1:8001/api/createPost", {
          newPost,
        })
        .then(() => {
          this.postName = "";
          this.postDescription = "";
          this.fetchPosts();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    

    sendComment(comment, post_id) {
      let newComment = {
        post_id: post_id,
        comment: comment,
      };

      axios
        .post("http://127.0.0.1:8002/api/addComment", {
          newComment,
        })
        .then(() => {
          this.comment = "";
          this.fetchComments();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
