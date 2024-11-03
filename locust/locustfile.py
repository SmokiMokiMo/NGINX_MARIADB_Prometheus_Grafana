from locust import HttpUser, TaskSet, task

class UserBehavior(TaskSet):
    @task(1)
    def index(self):
        self.client.get("/index.php")

class WebsiteUser(HttpUser):
    tasks = [UserBehavior]
    min_wait = 5000
    max_wait = 15000

