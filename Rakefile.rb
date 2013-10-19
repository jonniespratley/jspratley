#
# @author Jonnie Spratley - AppMatrix, Inc.
# @note This file contains tasks to help with deployment to live server, building the scripts, and cleaning up files. 
#



#cleanup
desc "remove all files from the temp folder"
task :cleanup do
  FileUtils.rm_rf "./temp/*"
end

#build
desc "Build the scripts and move to the public folder"
task :build do
  `yeoman build ~`
end

#deploy
desc "Deploy distribution build to web server"
task :deploy_d => :build do
  require 'net/ssh'
  require 'net/scp'
  
  server = 'jonniespratley.me'
  login = 'root'

  Net::SSH.start(server, login, :password => "fred3212") do |ssh|
    ssh.scp.upload!("public", "/var/www", { :recursive => true, :verbose => true }) do |ch, name, sent, total|
      puts "#{name}: #{sent}/#{total}"
    end
  end
end
  
#deploy to development server




#deploy to staging server



#deploy to production server
desc "Deploy distribution build to production server."
task :deploy => :build do
  require 'net/ssh'
  require 'net/scp'
  
  server = 'jonniespratley.me'
  login = 'root'
  
  Net::SSH.start(server, login, :password => "fred3212") do |ssh|
    ssh.scp.upload!("www", "/var", { :recursive => true, :verbose => true }) do |ch, name, sent, total|
      puts "#{name}: #{sent}/#{total}"
    end
  end
end


#Deploy readmes
desc "Deploy readme files to server."
task :deploy_readme => :build do
  require 'net/ssh'
  require 'net/scp'
  
  server = 'jonniespratley.me'
  login = 'root'
  
  Net::SSH.start(server, login, :password => "fred3212") do |ssh|
    ssh.scp.upload!("www/README.md", "/var", { :recursive => true, :verbose => true }) do |ch, name, sent, total|
      puts "#{name}: #{sent}/#{total}"
    end
  end
end

#Deploy views
desc "Deploy view files to server."
task :deploy_views => :build do
  require 'net/ssh'
  require 'net/scp'
  
  server = 'jonniespratley.me'
  login = 'root'
  
  Net::SSH.start(server, login, :password => "fred3212") do |ssh|
    ssh.scp.upload!("www/views", "/var", { :recursive => true, :verbose => true }) do |ch, name, sent, total|
      puts "#{name}: #{sent}/#{total}"
    end
  end
end

#Deploy views
desc "Deploy scripts files to server."
task :deploy_scripts => :build do
  require 'net/ssh'
  require 'net/scp'
  
  server = 'jonniespratley.me'
  login = 'root'
  
  Net::SSH.start(server, login, :password => "fred3212") do |ssh|
    ssh.scp.upload!("www/scripts", "/var", { :recursive => true, :verbose => true }) do |ch, name, sent, total|
      puts "#{name}: #{sent}/#{total}"
    end
  end
end