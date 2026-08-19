      <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo mt-4">
                <!-- Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">

                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('panel.index') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Management</h4>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('countries.index') }}">
                                <i class="fas fa-globe-americas"></i>
                                <p>Countries</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('educationsystem.index') }}">
                                <i class="fas fa-university"></i>
                                <p>Education System</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('educationlevel.index') }}">
                                <i class="fas fa-graduation-cap"></i>
                                <p>Education Level</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('subjects.index') }}">
                                <i class="fas fa-book-open"></i>
                                <p>Subjects</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">
                                <i class="fas fa-layer-group"></i>
                                <p>Categories</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sub-categories.index') }}">
                                <i class="fas fa-sitemap"></i>
                                <p>Sub Categories</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('courses.index') }}">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <p>Courses</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('lessons.index') }}">
                                <i class="fas fa-play-circle"></i>
                                <p>Lessons</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('quizzes.index') }}">
                                <i class="fas fa-question-circle"></i>
                                <p>Quizzes</p>
                            </a>
                        </li>

                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Business</h4>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                <p>Orders</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('transactions.index') }}">
                                <i class="fas fa-credit-card"></i>
                                <p>Transactions</p>
                            </a>
                        </li>




                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Users</h4>
                        </li>





                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#submenu">
                                <i class="fas fa-users"></i>
                                <p>User Management</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="submenu">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('users.index') }}">
                                            <i class="fas fa-user-shield"></i>
                                            <span class="sub-item">Administrators</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('teachers.index') }}">
                                            <i class="fas fa-chalkboard-user"></i>
                                            <span class="sub-item">Teachers</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('students.index') }}">
                                            <i class="fas fa-user-graduate"></i>
                                            <span class="sub-item">Students</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('families.index') }}">
                                            <i class="fas fa-users"></i>
                                            <span class="sub-item">Parents</span>
                                        </a>
                                    </li>

                                </ul>

                            </div>


  <li class="nav-item">
                            <a class="nav-link" href="{{ route('coupons.index') }}">
                                <i class="fas fa-sitemap"></i>
                                <p>Coupons</p>
                            </a>
                        </li>







                        </li>


                    </ul>
                </div>
            </div>
        </div>
